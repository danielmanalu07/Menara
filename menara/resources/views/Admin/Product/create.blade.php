@extends('Admin.Layout.welcome')
@section('title')
    Create Product Data
@endsection
@section('content')
    <div class="container d-block bg-gray-300">
        <h1>Create Product</h1>
        <form action="/admin/product" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control p-1" id="image" name="image">
            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="number" class="form-control" name="price">
            </div>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Product Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="" class="form-control">
                    <option value="">--Choose Category--</option>
                    @forelse ($category as $categories)
                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                    @empty
                        <option value="">Category Not Found</option>
                    @endforelse
                </select>
            </div>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="flavor_id" class="form-label">Flavor</label>
                <select name="flavor_id" id="" class="form-control">
                    <option value="">--Choose Flavor--</option>
                    @forelse ($flavors as $flavor)
                        <option value="{{ $flavor->id }}">{{ $flavor->name }}</option>
                    @empty
                        <option value="">Flavor Not Found</option>
                    @endforelse
                </select>
            </div>
            @error('flavor_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
