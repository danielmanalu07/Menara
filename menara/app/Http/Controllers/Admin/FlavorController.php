<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flavor;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flavor = Flavor::all();
        return view('Admin.Flavor.index', compact('flavor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Flavor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = [
            'name' => 'required',
        ];

        $message = [
            'name.required' => 'Flavor name is required',
        ];

        $this->validate($request, $validate, $message);

        $flavor = new Flavor;

        $flavor->name = $request->name;

        $flavor->save();
        return redirect('admin/flavor')->with('success_message', 'flavor ' . $flavor->name . ' Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $flavor = Flavor::find($id);
        return view('Admin.Flavor.edit', compact('flavor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = [
            'name' => 'required',
        ];

        $message = [
            'name.required' => 'Flavor name is required',
        ];

        $this->validate($request, $validate, $message);

        $flavor = Flavor::find($id);
        $flavor->name = $request['name'];

        $flavor->update();
        return redirect('/admin/flavor')->with('success_message', 'category ' . $flavor->name . ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flavor = Flavor::find($id);
        $flavor->delete();
        return redirect('/admin/flavor')->with('success_message', 'flavor ' . $flavor->name . ' Deleted Successfully');
    }
}
