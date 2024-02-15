<?php

namespace App\Http\Controllers;

use App\Models\seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{

    public function index() {
        $seats = seat::orderBy('book_date')->orderBy('available_time')->get();

        $grouped = $seats->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->book_date)->format('l, d M Y');
        });
    
        return view('admin.views.seat', compact('grouped'));
    }

    public function create() {
        return view('admin.action.seat.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'book_date' => 'required',
            'available_time' => 'required',
            'seat_left' => 'required'
        ]);
        seat::create($data);
        return redirect()->route('admin-seat');
    }
}
