<?php

namespace App\Http\Controllers;

use App\Models\affiliate;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function index() {
        $data = affiliate::latest()->get();
        return view('admin.views.affiliate', compact('data'));
    }

    public function create() {
        return view('admin.action.affiliate.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        affiliate::create($data);
        return redirect()->route('admin-affiliate');
    }
}
