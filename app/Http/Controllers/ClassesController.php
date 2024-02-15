<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function create() {
        return view('admin.action.class.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        Classes::create($data);
        return redirect()->route('admin-menu');
    }

    public function edit($id) {
        $class = Classes::findOrFail($id);
        return view('admin.action.class.edit', compact('class'));
    }
    

    public function update(Request $request, $id) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
    
        $class = Classes::findOrFail($id);
        $class->update($data);
    
        return redirect()->route('admin-menu');
    }    

    public function destroy($id) {
        $classes = Classes::findOrFail($id);
        $classes->delete();
        
        return redirect()->back()->with('success', 'Data customer berhasil dihapus');
    } 
}
