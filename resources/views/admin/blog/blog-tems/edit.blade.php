@extends('layout.admin-app')
@section('title_text', 'Edit Blog')
@section('page_title', 'Edit Blog')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Blog</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" value="{{ old('title', $blog->title) }}" name="title" class="form-control" id="title">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Slug *</label>
                            <input type="text" value="{{ old('slug', $blog->slug) }}" name="slug" class="form-control" id="slug">
                            @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                             <label for="category" class="form-label">Category *</label>
                            <select class="form-select" id="category" name="category">
                                <option selected="" disabled="" value="">Choose...</option>
                                @foreach ($categories as $category)
                                <option @selected($category->id == $blog->blog_category_id) value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" name="description" id="description"
                                aria-label="With textarea">{{ old('description', $blog->description) }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Image *</label>
                            <input type="file" name="image" class="form-control mb-2" id="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img id="blah" src="{{ asset($blog->image) }}" alt="your image" width="100" height="100" />
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label class="form-check-label" for="popular">Mark as a popular</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" {{ $blog->popular == 'on' ? 'checked' : '' }} name="popular" type="checkbox" role="switch" id="popular">
                        </div>
                        <div class="mb-1">
                            <label class="form-check-label" for="status">Visibility Status</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" {{ $blog->status == 'on' ? 'checked' : '' }} name="status" type="checkbox" role="switch" id="status">
                        </div>
                        <div class="form-group mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" value="{{ old('tags', $blog->tags) }}" name="tags" class="form-control tags" id="tags">
                            @error('tags')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="seo_title" class="form-label">SEO Title</label>
                            <input type="text" value="{{ old('seo_title', $blog->seo_title) }}" name="seo_title" class="form-control" id="seo_title">
                            @error('seo_title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="seo_description" class="form-label">SEO Description</label>
                            <textarea class="form-control" name="seo_description" id="seo_description"
                                aria-label="With textarea">{{ old('seo_description', $blog->seo_description) }}</textarea>
                            @error('seo_description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
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
        $(document).ready(function () {
            $('.tags').each(function() {
                new Tagify(this);
            });

            $('#description').summernote({
                height: 220,

            });
            $('#title').on('keyup', function () {
                const name = $(this).val();
                const slug = makeSlug(name);
                $('#slug').val(slug);
            })

        })

    </script>
    @endpush
