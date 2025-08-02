@extends('layout.admin-app')
@section('title_text', 'Testimonial List')
@section('page_title', 'Testimonial List')
@section('content')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="card-title">Testimonial List</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('testimonial.create') }}" class="btn btn-primary">+ Create New</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="testimonial_table" class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $testimonial)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $testimonial->name }}</td>
                                <td>{{ $testimonial->designation }}</td>
                                <td>
                                    <a href="{{ route('testimonial.edit',$testimonial->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form id="brand-delete" action="{{ route('testimonial.destroy',$testimonial->id) }}" method="POST"
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

        {{-- @foreach ($category as $cat)
            <p><a href="{{ route('testimonial.index',['category' => $cat->slug]) }}">{{ $cat->name }}</a></p>
        @endforeach
        @foreach ($blogs as $blog)
            <p>{{ $blog->title }}</p>
        @endforeach --}}
</div>

@endsection
@push('js')
<script>
    new DataTable('#testimonial_table');

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
