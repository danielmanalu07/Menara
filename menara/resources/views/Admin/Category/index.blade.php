@extends('Admin.Layout.welcome')
@section('title')
    Category List
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                var value = $(this).val().toLowerCase();
                $('#table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                Swal.fire({
                    title: 'Delete ' + '?',
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
                            url: "/admin/category/" + id,
                            type: "POST",
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The item has been deleted .',
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'There is an error! Items cannot be deleted because there is data in the item .'
                                });
                            }
                        });
                    }
                });
            });
            $(document).on('click', '.detail', function(e) {
                e.preventDefault();
                var name = $(this).data('name');
                var description = $(this).data('description');
                Swal.fire({
                    title: 'Category Detail',
                    html: '<strong>Category Name:</strong> ' + name +
                        '<br><strong>Category Description:</strong> ' + description,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
@endpush
@section('content')
    <div class="container bg-gray-300">
        <h1>Category List</h1>
        <div class="row mb-3 pt-3">
            <div class="col">
                <input type="text" id="search" class="form-control" placeholder="Search Category...">
            </div>
        </div>
        @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong> {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Category Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($category as $key => $items)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $items->name }}</td>
                        <td>{{ Str::limit($items->description, 30) }}</td>
                        <td>
                            <form action="/admin/category/{{ $items->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="" class="btn btn-primary btn-sm detail" data-name="{{ $items->name }}"
                                    data-description="{{ $items->description }}"><i class="fas fa-eye"></i>Detail</a>
                                <a href="/admin/category/{{ $items->id }}/edit" class="btn btn-warning btn-sm"><i
                                        class="fas fa-edit"></i>Edit</a>
                                <button type="submit" class="btn btn-danger btn-sm delete" name="{{ $items->nama }}"
                                    id="{{ $items->id }}"><i class="fas fa-trash"></i>Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            Data Not Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
