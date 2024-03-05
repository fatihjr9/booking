<?php

namespace App\Http\Controllers;

use App\Models\CategoryMenu;
use App\Models\Classes;
use App\Models\menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $classes = Classes::latest()->get();
        $menus = menu::latest()->get();
        return view('admin.views.menu', compact('menus','classes'));
    }

    public function create() {
        $data = CategoryMenu::latest()->get();
        return view('admin.action.menu.create', compact('data'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        menu::create($data);
        return redirect()->route('admin-menu');
    }

    public function edit($id) {
        $menu = menu::findOrFail($id);
        return view('admin.action.menu.edit', compact('menu'));
    }
    

    public function update(Request $request, $id) {
        $data = $request->validate([
            'description' => 'required',
        ]);
    
        $menu = menu::findOrFail($id);
        $menu->update($data);
    
        return redirect()->route('admin-menu');
    }    

    public function destroy($id) {
        $menu = menu::findOrFail($id);
        $menu->delete();
        
        return redirect()->back()->with('success', 'Data customer berhasil dihapus');
    }
}
