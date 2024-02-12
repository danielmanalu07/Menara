<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Flavor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        $category = Category::get();
        $flavor = Flavor::get();
        return view('Admin.Product.index', compact('product'), compact('category'), compact('flavor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::get();
        $flavors = Flavor::get();
        return view('Admin.Product.create', compact('category'), compact('flavors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = [
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required',
            'flavor_id' => 'required',
        ];

        $message = [
            'name.required' => 'Name is required',
            'image.required' => 'Image is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Only number allowed',
            'description.required' => 'Description is required',
            'category_id.required' => 'Category is required',
            'flavor_id.required' => 'Flavor is required',
        ];
        $this->validate($request, $validate, $message);

        $file = time() . '.' . $request->image->extension();
        $request->image->move(public_path('product_image'), $file);

        $product = new Product;

        $product->name = $request->name;
        $product->image = $file;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->flavor_id = $request->flavor_id;

        $product->save();

        return redirect('/admin/product')->with('success_message', 'product ' . $product->name . ' Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $category = Category::get();
        $flavors = Flavor::get();

        return view('Admin.Product.edit', compact('product', 'category', 'flavors'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = [
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required',
            'flavor_id' => 'required',
        ];

        $message = [
            'name.required' => 'Name is required',
            'image.required' => 'Image is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Only number allowed',
            'description.required' => 'Description is required',
            'category_id.required' => 'Category is required',
            'flavor_id.required' => 'Flavor is required',
        ];
        $this->validate($request, $validate, $message);

        $product = Product::find($id);
        if ($request->has('image')) {
            $path = 'product_image/';
            File::delete($path . $product->image);
            $file = time() . '.' . $request->image->extension();

            $request->image->move(public_path('product_image'), $file);

            $product->image = $file;

            $product->update();
        }

        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->description = $request['description'];
        $product->category_id = $request['category_id'];
        $product->flavor_id = $request['flavor_id'];

        $product->update();

        return redirect('/admin/product')->with('success_message', 'product ' . $product->name . '  has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/admin/product')->with('success_message', 'product ' . $product->name . '  has been deleted');
    }
}
