@extends('Admin.Layout.welcome')
@section('title')
    Edit Flavor Data
@endsection
@section('content')
    <div class="container bg-gray-300 p-2">
        <h1>Edit Flavor Data</h1>
        <form action="/admin/flavor/{{ $flavor->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Flavor:</label>
                <input type="text" class="form-control" id="nama" name="name" placeholder="Enter Flavor Name"
                    value="{{ $flavor->name }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
            <a href="/admin/flavor" class="btn btn-danger btn-sm">Cancel</a>
        </form>
    </div>
@endsection
