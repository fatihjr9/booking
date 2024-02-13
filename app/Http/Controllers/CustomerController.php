<?php

namespace App\Http\Controllers;

use App\Models\affiliate;
use App\Models\customer;
use App\Models\menu;
use App\Models\seat;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $data = customer::latest()->get();
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
        $data['menu'] = implode(',', $data['menu']);
        $data['affiliate'] = $request->input('affiliate');

        if (!empty($affiliateCode)) {
            $affiliate = Affiliate::where('url', $affiliateCode)->first();
            if ($affiliate) {
                // Jika affiliate ditemukan, tambahkan clicked count
                $affiliate->increment('clicked_count');
            } else {
                // Jika affiliate tidak ditemukan, tampilkan pesan error
                return redirect()->back()->with('error', 'Affiliate not found');
            }
        }

        // Decreasing seats total
        $seats = seat::whereDate('book_date', $data['book_date'])
                  ->where('available_time', $data['book_time'])
                  ->firstOrFail();
        if ($seats->seat_left < $data['person']) {
            // If seats are fully booked, return back with an error message
            return redirect()->back()->with('error', 'Seat full booked');
        }
        $seats->seat_left -= $data['person'];
        $seats->save();

        // Bersihkan session setelah selesai
        $request->session()->forget('selected_date');
        $request->session()->forget('selected_time');

        customer::create($data);
        return redirect()->route('client-create');
    }

    public function destroy($id) {
        $customer = customer::findOrFail($id);
        $customer->delete();
        
        return redirect()->back()->with('success', 'Data customer berhasil dihapus');
    }    
}
