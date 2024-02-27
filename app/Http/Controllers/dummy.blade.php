<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Classes;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Seat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    // Fungsi untuk membuat tanda tangan digital dengan kunci privat RSA
    private function createDigitalSignature($data)
    {
        $privateKey = file_get_contents(storage_path('app/priv-key.pem'));
        openssl_sign(json_encode($data), $signature, $privateKey, OPENSSL_ALGO_SHA256);
        return base64_encode($signature);
    }

    // Fungsi untuk menampilkan form pembelian tiket
    public function create(Request $request)
    {
        // Dapatkan URL affiliate dari parameter request
        $affiliateUrl = $request->session()->get('affiliate_url');
        // Filter Seat by date
        $dates = $request->input('book_date');
        $seats = Seat::whereDate('book_date', $dates)->get();
        $menu = Menu::all();
        $class = Classes::latest()->get();
        // Deklarasi nilai input
        $setDate = $request->input('book_date');
        $setTime = $request->input('book_time');
        // Simpan nilai dalam session
        $request->session()->put('selected_date', $setDate);
        $request->session()->put('selected_time', $setTime);
        // Ambil nilai dari session untuk tanggal dan waktu yang dipilih
        $selectedDate = $request->session()->get('selected_date');
        $selectedTime = $request->session()->get('selected_time');
        return view('client.index', compact('seats','class','dates','menu', 'setDate', 'setTime', 'selectedTime', 'affiliateUrl'));
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
            'country'=> 'required',
            'person'=> 'required', 
            'book_date'=> 'required',
            'book_time'=> 'required', 
            'menu'=> 'required|array', 
            'amount'=> 'required|string', 
            'payment'=> 'required'
        ]);
        // Logika lainnya
        $data['menu'] = implode(',', $data['menu']);
        $data['affiliate'] = $request->input('affiliate');
        $selectedBookingTimes = $request->input('book_time');
        // Pengaturan Kode Afiliasi
        $codeAffiliate = $request->input('affiliate');
        if (!empty($codeAffiliate)) {
            $affiliate = Affiliate::where('url', $codeAffiliate)->first();
            if ($affiliate) {
                $affiliate->increment('clicked_count');
            } else {
                return redirect()->back()->with('error', 'Afiliasi tidak ditemukan');
            }
        }
        // Ketersediaan Tempat Duduk
        $seats = Seat::whereDate('book_date', $data['book_date'])
            ->where('available_time', $data['book_time'])
            ->firstOrFail();
        if ($seats->seat_left < $data['person']) {
            return redirect()->back()->with('error', 'Tempat duduk sudah penuh');
        }
        $seats->seat_left -= $data['person'];
        $seats->save();
        // Bersihkan data sesi
        $request->session()->forget('selected_date');
        $request->session()->forget('selected_time');
        // Akhir
        $customer = Customer::create($data);
        // Integrasi Pembayaran
        if ($request->payment == 'Cash') {
            return redirect()->route('client-success');
        } elseif ($request->payment == 'Local Bank') {
            // Integrasi Midtrans
            $payload = [
                'transaction_details' => [
                    'order_id' => $noInvoice,
                    'gross_amount' => $request->amount,
                ],
            ];
            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            return view('client.order', compact('snapToken','noInvoice', 'data'));
        } elseif ($request->payment == 'Paypal') {
            $response = Http::post('http://localhost:8000', $request->all());
            if ($response->failed()) {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat pembayaran PayPal. Silakan coba lagi nanti.');
            }
            $signature = $response->json('signature');
            // Integrasi Cashlez
            $payload = [
                'data' => [
                    'referenceId' => $noInvoice,
                    'amount' => $request->amount,
                ],
            ];
            $signature = $this->createDigitalSignature($payload);
            $response = Http::post('https://api-link.cashlez.com/generate_url_vendor', [
                'request' => $payload, 
                'signature' => $signature,
            ]);
            return $response->json();
        } else {
            return redirect()->back()->with('error', 'Metode pembayaran yang dipilih tidak valid.');
        }
    }

    // Fungsi untuk menampilkan pembelian tiket
    public function index()
    {
        $data = Customer::latest()->get();
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

public function create()
{
    $menu = Menu::all();
    $class = Classes::latest()->get();

    // Ambil data kursi berdasarkan book_date
    $seats = Seat::all();

    // Siapkan array events
    $events = [];
    foreach ($seats as $seat) {
        // Ambil tanggal dari book_date
        $selectedDate = $seat->book_date;

        // Convert string to DateTime object
        $availableTime = new \DateTime($seat->available_time);

        // Format DateTime object
        $formattedTime = $availableTime->format('Y-m-d\TH:i:s');

        // Pisahkan string seat_left menjadi array berdasarkan spasi
        $seatLeftArray = explode(' ', $seat->seat_left);

        // Tambahkan 'Seat Left' setelah setiap elemen array
        $seatLeftArray = array_map(function($value) {
            return $value . ' Seat Left';
        }, $seatLeftArray);

        // Tambahkan data kursi ke dalam array events
        $events[] = [
            'title' => $seatLeftArray,
            'start' => $formattedTime,
        ];
    }

    // Kirim data ke view untuk ditampilkan
    return view('client.index', compact('class', 'menu', 'events'));
}