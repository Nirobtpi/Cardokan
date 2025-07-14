@extends('layout.admin-app')
@section('title_text', 'City List')
@section('page_title', 'City List')
@section('content')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="card-title">City List</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('city.create') }}" class="btn btn-primary">+ City Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="City_table" class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">City Name</th>
                            <th scope="col">Country Name</th>
                            <th scope="col">Total Car</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($cities->count() >0)
                            @foreach ($cities as $city)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->country->name }}</td>
                                    <td>{{ $city->cars->count() }}</td>
                                    <td>
                                        <a href="{{ route('city.edit',$city->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form id="brand-delete" action="{{ route('city.destroy',$city->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn btn-sm btn-danger delete-btn">Delete</button>
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
    @foreach($errors -> all() as $error)
    toastr.error('{{ $error }}', 'Error');
    @endforeach

    new DataTable('#City_table');

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
