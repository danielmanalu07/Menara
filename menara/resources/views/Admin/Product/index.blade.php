@extends('Admin.Layout.welcome')

@section('title')
    Product List
@endsection

@push('style')
    <style>
        .swal2-image {
            max-width: 100%;
            max-height: 200px;
        }
    </style>
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#searching').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.col-md-4').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var name = $(this).data('name');
                Swal.fire({
                    title: 'Delete ' + name + '?',
                    text: "You won't be able to return this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/product/" + id,
                            type: "POST",
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The item has been deleted.',
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'There is an error! Items cannot be deleted because there is data in the item.'
                                });
                            }
                        });
                    }
                });
            });
            $(document).on('click', '.detail', function(e) {
                e.preventDefault();
                var name = $(this).data('name');
                var price = $(this).data('price');
                var image = $(this).data('image');
                var description = $(this).data('description');

                Swal.fire({
                    title: 'Product Detail',
                    html: `
                        <div>
                            <strong>Name:</strong> ${name}<br>
                            <strong>Price:</strong> Rp. ${price}<br>
                            <strong>Description:</strong> ${description}
                        </div>`,
                    imageUrl: image,
                    imageAlt: name,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
@endpush

@section('content')
    <div class="container bg-gray-300">
        @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong> {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1>Product List</h1>
        <div class="row mb-3 pt-3">
            <div class="col">
                <input type="text" id="searching" class="form-control" placeholder="Search Product...">
            </div>
        </div>
        <div class="row">
            @forelse ($product as $items)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('product_image/' . $items->image) }}" class="card-img-top w-100"
                            style="height: 200px" alt="{{ $items->name }}">
                        <div class="card-body">
                            <h4 class="card-title"><strong>Name : </strong>{{ Str::limit($items->name, 15) }}</h4>
                            <h4 class="card-text"><strong>Description : </strong>{{ Str::limit($items->description, 30) }}
                            </h4>
                            <h4 class="card-text"><strong>Harga : Rp. </strong>{{ $items->price }}</h4>

                            <div class="btn-group mt-2" role="group" aria-label="Basic example">
                                <a href="#" class="btn btn-primary me-2 detail" data-name="{{ $items->name }}"
                                    data-price="{{ $items->price }}"
                                    data-image="{{ asset('product_image/' . $items->image) }}"
                                    data-description="{{ $items->description }}">Detail</a>
                                <a href="/admin/product/{{ $items->id }}/edit" class="btn btn-warning ml-2"
                                    data-id="{{ $items->id }}" data-name="{{ $items->name }}">Edit</a>
                                <button type="button" class="btn btn-danger ml-2 delete" data-id="{{ $items->id }}"
                                    data-name="{{ $items->name }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p>No products found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
