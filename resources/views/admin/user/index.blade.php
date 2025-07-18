@extends('layout.admin-app')
@section('title_text', 'User List')
@section('page_title', 'User List')
@section('content')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="card-title">User List</h2>
                    </div>
                </div>
            </div>

            {{-- @php
                $validdate=Carbon\Carbon::createFromFormat('Y-m-d','2026-07-5');
                $today=Carbon\Carbon::today()->format('d-m-Y');
                $diff=$validdate->diffInDays($today,false);
                echo abs(round($diff));
            @endphp --}}

            <div class="card-body">
                <table id="user_table" class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                    <input class="form-check-input" name="status" onclick="userStatusUpdate({{ $user->id }})" type="checkbox" role="switch" id="status" {{ $user->status == 'inactive'?'':'checked' }}>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form id="brand-delete" action="{{ route('user.destroy',$user->id) }}" method="POST"
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
        </div>
</div>
@endsection
@push('js')
<script>

    function userStatusUpdate(id){
        console.log(id);
        let route="{{ route('user.status',':id') }}"
        $.ajax({
            url:route.replace(':id',id),
            type:'GET',
            success:function(data){
                toastr.success(data.message);
            }
        });
    }

    new DataTable('#user_table');

    $(document).ready(function(){
        $(document).on('click','.delete-btn',function(e){
            e.preventDefault();
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
                $(this).closest('form').submit();
            }
        });
    });
})

</script>
@endpush
