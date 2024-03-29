<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Affiliate;
use phpseclib3\Crypt\RSA;
use App\Models\Classes;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Seat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\CryptoHelper;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function create(Request $request)
    {
        $menu = Menu::all();
        $class = Classes::latest()->get();
        // affiliate
        $affiliate = $request->query('affiliate');
        $request->session()->put('affiliate', $affiliate);

        // Fetch seat data
        $seats = Seat::all();

        // Prepare events array
        $events = [];
        foreach ($seats as $seat) {
            // Convert string to DateTime object
            $availableTime = new \DateTime($seat->available_time);

            // Format DateTime object
            $formattedTime = $availableTime->format('Y-m-d\TH:i:s');
            $seatLeftArray = explode(' ', $seat->seat_left);

            // Add 'Seat' prefix to each element of the array
            $seatLeftArray = array_map(function($value) {
                return $value . ' Seat Left';
            }, $seatLeftArray);
            $events[] = [
                'title' => $seatLeftArray,
                'start' => $formattedTime,
            ];
        }

        // Set session untuk tanggal dan waktu yang dipilih
        $selectedTime = $request->session()->get('selected_time');

        return view('client.index', compact('class', 'menu', 'events', 'selectedTime', 'affiliate'));
    }
    // Fungsi untuk menyimpan pembelian tiket
    public function store(Request $request)
    {
        // Set kode acak
        $length = 6;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }
        $noInvoice = 'TRX-' . Str::upper($random);

        // Kirim ke DB
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone'=> 'required',
            'packages'=> 'required',
            'country'=> 'required',
            'book_time'=> 'required', 
            'menu'=> 'required|array', 
            'amount'=> 'required|string',
        ]);

        // Logika lainnya
        $data['menu'] = implode(',', $data['menu']);
        $data['affiliate'] = $request->input('affiliate');
        $data['person'] = $request->input('person');
        $data['request'] = $request->input('request');
        $data['party'] = $request->input('party');
        $data['birthday'] = $request->input('birthday');
        $data['quantity'] = $request->input('quantity');
        // Callback 
        $callback = 'https://shipwreckbali.com/pubcrawl.html';

        // Bersihkan data sesi
        $request->session()->forget('selected_time');
        $affiliate = $request->input('affiliate');

        // Load kunci privat dari penyimpanan
        $privateKey = openssl_get_privatekey(file_get_contents(storage_path('priv-key.pem')));
        $unformattedAmount = preg_replace('/[^0-9]/', '', $request->amount);
        $amount = $unformattedAmount;
        // Persiapkan payload yang akan ditandatangani
        $payloadToSign = json_encode([
            "request" => [
                "vendorIdentifier" => "CZ00TEST003",
                "referenceId" => $noInvoice,
                "entityId" => "23273",
                "merchantName" => "BEER SHIP PUB CRAWL",
                "merchantDescription" => "",
                "currencyCode" => "IDR",
                "amount" => $amount ,
                "callbackSuccess" => $callback,
                "callbackFailure" => "",
                "message" => "",
                "description" => $request->packages . "\n" . implode(', ', $request->menu),
                "transactionUsername" => "test03"
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);        
        
        $signature = '';
        if (openssl_sign($payloadToSign, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            $signatureBase64 = base64_encode($signature);
        } else {
            $errorCode = openssl_error_string();
        }
        
        // Integrasi Pembayaran 
        $urls = 'https://api-link.cashlez.com';
        $payload = [
            "data" => json_decode($payloadToSign, true),
            "signature" => $signatureBase64
        ];
        // payment
        $req = Http::withHeaders(['Content-Type' => 'application/json'])->post($urls . '/generate_url_vendor', $payload);
        $res = $req->json();
        $generatedUrl = $res['data']['response']['generatedUrl'];
        // pick payment that chosen by user
       
        if ($req->successful()) {
            Mail::to($request->email)->send(new SendEmail($data));
            Customer::create($data);
            return view('client.payment', compact('generatedUrl'));
        } else {
            return response()->json(['message' => 'Failed to connect to payment gateway'], 500);
        }        
    }
    // Fungsi untuk menampilkan pembelian tiket
    public function index()
    {
        $data = Customer::latest()->paginate(5);
        return view('admin.views.customer', compact('data'));
    }

    // Fungsi untuk menghapus data pelanggan
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->back()->with('success', 'Data pelanggan berhasil dihapus');
    }
}