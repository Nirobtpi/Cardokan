@extends('layout.admin-app')
@section('title_text', 'Blog Category List')
@section('page_title', 'Blog Category List')
@section('content')

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2 class="card-title">Country List</h2>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('blog-category.create') }}" class="btn btn-primary">+ Categoty Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="blog_category_table" class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <a href="{{ route('blog-category.edit',$category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form id="brand-delete" action="{{ route('blog-category.destroy',$category->id) }}" method="POST"
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
    new DataTable('#blog_category_table');

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
