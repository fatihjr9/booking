<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
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
            'store_name' => 'required',
            'manager'=>'required',
            'email'=>'required',
            'whatsapp'=>'required|string',
            'bank_name'=>'required',
            'account_numb'=>'required|string',
            'account_holder'=>'required',
        ]);
        // Random URL
        $rand = Str::random(mt_rand(2, 5));
        $data['url'] = $data['manager'].'-'.$rand;
        // end random url
        affiliate::create($data);
        return redirect()->route('admin-affiliate');
    }
}
