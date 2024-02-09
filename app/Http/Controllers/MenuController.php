<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $data = menu::latest()->get();
        return view('admin.views.menu', compact('data'));
    }

    public function create() {
        return view('admin.action.menu.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        menu::create($data);
        return redirect()->route('admin-menu');
    }
}
