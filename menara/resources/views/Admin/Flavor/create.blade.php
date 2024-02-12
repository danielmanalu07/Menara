@extends('Admin.Layout.welcome')
@section('title')
    Create Flavor Data
@endsection
@section('content')
    <div class="container bg-gray-300 p-2">
        <h1>Create Flavor Data</h1>
        <form action="/admin/flavor" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Flavor:</label>
                <input type="text" class="form-control" id="nama" name="name" placeholder="Enter Flavor Name">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
