<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('Admin.Category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = [
            'name' => 'required',
            'description' => 'required',
        ];

        $message = [
            'nama.required' => 'Category Name is required',
            'description.required' => 'Category Description is required',
        ];

        $this->validate($request, $validate, $message);
        $category = new Category;

        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();
        return redirect('/admin/category')->with('success_message', 'category ' . $category->name . ' Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $category = Category::find($id);
        // return view('Admin.Category.read', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('Admin.Category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = [
            'name' => 'required',
            'description' => 'required',
        ];

        $message = [
            'nama.required' => 'Category Name is required',
            'description.required' => 'Category Description is required',
        ];
        $this->validate($request, $validate, $message);

        $category = Category::find($id);
        $category->name = $request['name'];
        $category->description = $request['description'];

        $category->update();
        return redirect('/admin/category')->with('success_message', 'category ' . $category->name . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/admin/category')->with('success_message', 'category ' . $category->name . ' Deleted Successfully');
    }
}
