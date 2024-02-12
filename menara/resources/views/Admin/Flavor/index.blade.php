@extends('Admin.Layout.welcome')
@section('title')
    Flavor List
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#searching').keyup(function() {
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
                            url: "/admin/flavor/" + id,
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
                Swal.fire({
                    title: 'Flavor Detail',
                    text: 'Flavor Name: ' + name,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
@endpush
@section('content')
    <div class="container bg-gray-300">
        <h1>Flavor List</h1>
        <div class="row mb-3 pt-3">
            <div class="col">
                <input type="text" id="searching" class="form-control" placeholder="Search Flavor...">
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
                    <th scope="col">Flavor Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($flavor as $key => $flavors)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $flavors->name }}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm detail" data-name="{{ $flavors->name }}">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="/admin/flavor/ {{ $flavors->id }}/edit" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="submit" class="btn btn-danger btn-sm delete" name="{{ $flavors->name }}"
                                id="{{ $flavors->id }}"><i class="fas fa-trash"></i>Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Data Not Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
