@extends('layout.admin-app')
@section('title_text', 'Add Blog Category')
@section('page_title', 'Add Blog Category')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Blog Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog-category.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Category Name *</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Category Slug *</label>
                            <input type="text" name="slug" class="form-control" id="slug">
                            @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-1">
                             <label class="form-check-label" for="status">Visibility Status</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="status">
                        </div>
                        <div class="from-grop">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @push('js')
    <script>
        $(document).ready(function() {

            $('#name').on('keyup',function(){
                const name = $(this).val();
                const slug = makeSlug(name);
                $('#slug').val(slug);
            })
        })
    </script>
    @endpush
