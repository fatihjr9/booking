<?php

namespace App\Http\Controllers;

use App\Models\affiliate;
use App\Models\customer;
use App\Models\menu;
use Illuminate\Support\Str;
use App\Models\seat;
use Illuminate\Http\Request;
use Midtrans\Transaction;

class CustomerController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function index() {
        $data = customer::latest()->get();
        // dd($data);
        return view('admin.views.customer', compact('data'));
    }

    public function create(Request $request) {
        // Dapatkan URL affiliate dari parameter request
        $affiliateUrl = $request->session()->get('affiliate_url');
        // Filter Seat by date
        $dates = $request->input('book_date');
        $seats = seat::whereDate('book_date', $dates)->get();
        $menu = menu::latest()->get();
        // Declaring input value
        $setDate = $request->input('book_date');
        $setTime = $request->input('book_time');
        // Simpan nilai dalam session
        $request->session()->put('selected_date', $setDate);
        $request->session()->put('selected_time', $setTime);
    
        // Ambil nilai dari session untuk tanggal dan waktu yang dipilih
        $selectedDate = $request->session()->get('selected_date');
        $selectedTime = $request->session()->get('selected_time');
    
        return view('client.index', compact('seats','dates','menu', 'setDate', 'setTime', 'selectedTime', 'affiliateUrl'));
    }
    
    
    public function store(Request $request) {
        // Set Random Code
        $length = 6;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }

        $no_invoice = 'TRX-'.Str::upper($random);
        // Send to DB
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
            // Other Logic Start
            $data['menu'] = implode(',', $data['menu']);
            $data['affiliate'] = $request->input('affiliate');
            // Affiliate Code Setting
            $codeAffiliate = $request->input('affiliate');
            if (!empty($codeAffiliate)) {
                $affiliate = Affiliate::where('url', $codeAffiliate)->first();
                if ($affiliate) {
                    $affiliate->increment('clicked_count');
                } else {
                    return redirect()->back()->with('error', 'Affiliate not found');
                }
            }
            
            // Availability Seats
            $seats = Seat::whereDate('book_date', $data['book_date'])
              ->where('available_time', $data['book_time'])
              ->firstOrFail();
            if ($seats->seat_left < $data['person']) {
                return redirect()->back()->with('error', 'Seat fully booked');
            }
            $seats->seat_left -= $data['person'];
            $seats->save();

            // Clear session data
            $request->session()->forget('selected_date');
            $request->session()->forget('selected_time');

            // End
            $customer = customer::create($data);
            $trx_id = $customer->trx_id;
        // Midtrans Integration
        $payload = [
            'transaction_details' => [
                'order_id' => $no_invoice,
                'gross_amount' => $request->amount,
            ],
        ];
        $snapToken = \Midtrans\Snap::getSnapToken($payload);
        return view('client.order', compact('snapToken','no_invoice', 'data'));
    }

    public function destroy($id) {
        $customer = customer::findOrFail($id);
        $customer->delete();
        
        return redirect()->back()->with('success', 'Data customer berhasil dihapus');
    }    
}
