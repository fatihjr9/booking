<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\affiliate;
use App\Models\CategoryMenu;
use App\Models\customer;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function index() {
        $data = affiliate::latest()->get();
        return view('admin.views.affiliate', compact('data'));
    }

    public function create() {
        $data = CategoryMenu::all();
        return view('admin.action.affiliate.create', compact('data'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'store_name' => 'required',
            'manager'=>'required',
            'email'=>'required',
            'category'=>'required',
            'whatsapp'=>'required|string',
            'bank_name'=>'required',
            'fees'=>'required',
            'account_numb'=>'required|string',
            'account_holder'=>'required',
        ]);
        // Random URL
        $rand = Str::random(mt_rand(2, 8));
        $data['url'] = $data['manager'].'-'.$rand;
        // end random url
        affiliate::create($data);
        return redirect()->route('admin-affiliate');
    }

    public function destroy($id) {
        $customer = affiliate::findOrFail($id);
        $customer->delete();
        
        return redirect()->back()->with('success', 'Data customer berhasil dihapus');
    }
    
}
