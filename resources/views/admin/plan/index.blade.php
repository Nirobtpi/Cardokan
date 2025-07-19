@extends('layout.admin-app')
@section('title_text', 'Plan List')
@section('page_title', 'Plan List')
@section('content')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="card-title">Plan List</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('plan.create') }}" class="btn btn-primary">+ Plan Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="City_table" class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Plan Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Expiration</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($plans->count() >0)
                        @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $plan->name }}</td>
                            <td>{{ $plan->price }}</td>
                            <td>
                                @php
                                    if($plan->expair_date =='lifetime'){
                                       echo '<span class="badge text-bg-primary">Lifetime</span>';
                                    }else{
                                        $created_at = Carbon\Carbon::parse($plan->created_at)->startOfDay();
                                        $expairDate= Carbon\Carbon::parse($plan->expair_date)->startOfDay();
                                        $diff=$created_at->diffInDays($expairDate,false);

                                        if($diff >0){
                                            echo '<span class="badge text-bg-success">'.$diff.' days remaining.</span>';
                                        }else{
                                             echo '<span class="badge text-bg-danger">Expaired</span>';
                                        }
                                    }
                                @endphp
                            </td>
                            <td><span class="badge {{ $plan->status == 'on'?'bg-success':'bg-danger' }}">{{ $plan->status =='on'?'Active':'Inactive' }}</span></td>
                            <td>
                                <a href="{{ route('plan.edit',$plan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form id="brand-delete" action="{{ route('plan.destroy',$plan->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
        </div>
    </div>

    @endsection
    @push('js')
    <script>
        new DataTable('#City_table');

        $(document).ready(function () {
            $(document).on('click', '.delete-btn', function (e) {
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
