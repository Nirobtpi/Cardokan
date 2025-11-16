@extends('layout.admin-app')
@section('title_text', 'Admin Role List')
@section('page_title', 'Admin Role List')
@section('content')

<div class="container">
    <div class="row">

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    {{-- <div class="search">
                        <input type="text" name="search" id="searchInput" placeholder="Search..." class="form-control">
                    </div> --}}
                    <a href="{{ route('adminteam.createRole') }}" class="btn btn-primary">+ Create New</a>
                </div>

            </div> <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th style="width: 10px" scope="col">Serial</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            {{-- <th scope="col">Status</th> --}}
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach ($roles as $key=>$role)
                        <tr class="align-middle">
                            <td>{{ $roles->firstItem() + $key }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->is_super_admin == 1 ? 'Super Admin' : 'Team Admin' }}</td>
                            <td>

                                @if($role->is_system_role == 0)
                                    <a href="{{ route('adminteam.roleUpdatePage', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form id="adminteam-delete" action="{{ route('adminteam.destroy', $role->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn btn-sm btn-danger delete-btn">Delete</button>
                                    </form>
                                @else
                                    <span class="text-muted">Restricted</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
            {{-- @if( $brands->total()>5)
            <div class="card-footer clearfix">
                {{ $brands->links('vendor.pagination.custom') }}
            </div>
            @endif --}}
        </div>
    </div>

    @endsection
    @push('js')
    <script>

    </script>

    @endpush
