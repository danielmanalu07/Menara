@extends('Admin.Layout.welcome')
@section('title')
    Edit Data Category
@endsection
@section('content')
    <div class="container-block justify-content-center align-items-center vh-100">
        <div class="card p-4 bg-gray-300">
            <form action="/admin/category/ {{ $category->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 pt-3">
                    <label for="name" class="form-label text-dark"><strong>Category Name</strong></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="description" class="form-label text-dark"><strong>Description</strong></label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $category->description }}</textarea>
                </div>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                <a href="/admin/category" class="btn btn-danger btn-sm">Cancel</a>
            </form>
        </div>
    </div>
@endsection
