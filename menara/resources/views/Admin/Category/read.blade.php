@extends('Admin.Layout.welcome')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Category Details</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/category" class="btn btn-info">Back to Categories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
