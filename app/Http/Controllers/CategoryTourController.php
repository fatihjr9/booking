<?php

namespace App\Http\Controllers;

use App\Models\CategoryTour;
use Illuminate\Http\Request;

class CategoryTourController extends Controller
{
    public function index()
    {
        $data = CategoryTour::latest()->get();
        return view('admin.views.menu', compact('data'));
    }

    public function create()
    {
        return view('admin.action.category_tour.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        CategoryTour::create($data);
        return redirect()->route('admin-menu');
    }
}
