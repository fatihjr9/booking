<?php

namespace App\Http\Controllers;

use App\Models\seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index() {
        $data = seat::orderBy('book_date')->get();
        $grouped = $data->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('l, d M Y');
        });

        return view('admin.views.seat', compact('data', 'grouped'));
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
