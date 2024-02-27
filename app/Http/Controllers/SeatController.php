<?php

namespace App\Http\Controllers;

use App\Models\CategoryTour;
use App\Models\seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{

    public function index() {
        $seats = seat::latest()->get();

    
        return view('admin.views.seat', compact('seats'));
    }

    public function create() {
        $data = CategoryTour::all();
        return view('admin.action.seat.create', compact('data'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'available_time' => 'required',
            'seat_left' => 'required'
        ]);
        seat::create($data);
        return redirect()->route('admin-seat');
    }
}
