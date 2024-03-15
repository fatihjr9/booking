<?php

namespace App\Http\Controllers;

use App\Models\CategoryTour;
use App\Models\seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{

    public function index() {
        $seats = seat::all();
        return view('admin.views.seat', compact('seats'));
    }

    public function create() {
        $data = CategoryTour::all();
        return view('admin.action.seat.create', compact('data'));
    }

    public function store(Request $request) {
        $availableDate = $request->input('available_date');
        $seatLeft = $request->input('seat_left');
    
        // Validasi input jika diperlukan
        $request->validate([
            'available_date' => 'required|date',
            'seat_left.*' => 'required|numeric|min:0'
        ]);
    
        // Inisialisasi variabel $timeSlots
        $timeSlots = ['12:00', '14:30', '17:00', '19:30', '22:00'];
    
        foreach ($seatLeft as $key => $seat) {
            $time = $timeSlots[$key];
            Seat::create([
                'available_time' => $availableDate . ' ' . $time . ':00',
                'seat_left' => $seat
            ]);
        }
        
        return redirect()->route('admin-seat');
    }
          

    public function edit($id) {
        $seat = seat::findOrFail($id);
        return view('admin.action.seat.edit', compact('seat'));
    }
    

    public function update(Request $request, $id) {
        $data = $request->validate([
            'seat_left' => 'required'
        ]);
    
        $class = seat::findOrFail($id);
        $class->update($data);
    
        return redirect()->route('admin-seat');
    }  

    public function destroy($id) {
        $seat = seat::findOrFail($id);
        $seat->delete();
        
        return redirect()->back()->with('success', 'Data customer berhasil dihapus');
    }
}
