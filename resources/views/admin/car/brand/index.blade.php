@extends('layout.admin-app')
@section('title_text', 'Brand List')
@section('page_title', 'Brand List')
@section('content')

<div class="container">
    <div class="row">

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Bordered Table</h3>
                    <a href="{{ route('brand.create') }}" class="btn btn-primary">+ Create New</a>
                </div>

            </div> <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th style="width: 10px" scope="col">Serial</th>
                            <th scope="col">Name</th>
                            <th scope="col">Total Car</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key=>$brand)
                        <tr class="align-middle">
                            <td>{{ $brands->firstItem() + $key }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>{{ $brand->status }}</td>
                            <td><a href="{{ route('brand.status', $brand->id) }}"
                                    class="{{ $brand->status == 1 ? 'badge text-bg-dark text-light' : 'badge text-bg-danger' }}">{{ $brand->status ==1 ? 'Active' : 'Inactive' }}</a>
                            </td>
                            <td>
                                <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form id="brand-delete" action="{{ route('brand.destroy', $brand->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  class="btn btn-sm btn-danger delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $brands->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

    @endsection
    @push('js')
    <script>
        @foreach($errors -> all() as $error)
        toastr.error('{{ $error }}', 'Error');
        @endforeach

    </script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click',function(event){
                event.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#brand-delete').submit();
                    }
                });
            })

        }); 

    </script>
    @endpush
