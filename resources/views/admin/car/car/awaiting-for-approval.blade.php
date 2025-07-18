@extends('layout.admin-app')
@section('title_text', 'Awaiting Car List')
@section('page_title', 'Awaiting Car List')
@section('content')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="card-title">Awaiting Car List</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('car.create') }}" class="btn btn-primary">+ Car Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="feature_table" class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Title</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Price</th>
                            <th scope="col">Dealer</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->brand->brand_name }}</td>
                            <td>{{ $car->price }}</td>
                            <td>{{ $car->user->name }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    {{-- <form action="{{ route('status.check',$car->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') --}}
                                        <input class="form-check-input status-update" name="status"  onclick="statusUpdate({{ $car->id }})"
                                            type="checkbox" role="switch" {{ $car->is_approve == 1 ?'checked':''}}>
                                    {{-- </form> --}}
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('car.edit',$car->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form id="brand-delete" action="{{ route('car.destroy',$car->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                </form>
                                 {{-- @php
                                    $time=Carbon\Carbon::createFromFormat('Y-m-d','2025-07-5');
                                    $date1=Carbon\Carbon::parse($car->created_at);
                                    $diff=$time->diffInDays($date1,false);
                                     if ($diff < 0) {
                                        echo abs(intval($diff)) . ' day' . (abs(intval($diff)) > 1 ? 's' : '') . ' remaining';
                                    } else {
                                        echo 'Expire';
                                    }
                                @endphp --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    new DataTable('#feature_table');

    function statusUpdate(id){
        let route="{{ route('status.check',':id') }}"
        $.ajax({
            url:route.replace(':id',id),
            type:'GET',
            success:function(data){
                toastr.success(data.message);
                setTimeout(function(){
                    location.reload();
                }, 1000);
            }
        })
    }

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
