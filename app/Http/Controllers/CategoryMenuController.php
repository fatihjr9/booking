<?php

namespace App\Http\Controllers;

use App\Models\CategoryMenu;
use Illuminate\Http\Request;

class CategoryMenuController extends Controller
{
    public function index()
    {
        $data = CategoryMenu::latest()->get();
        return view('admin.views.seat', compact('data'));
    }

    public function create()
    {
        return view('admin.action.category.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        CategoryMenu::create($data);
        return redirect()->route('admin-seat');
    }
}
