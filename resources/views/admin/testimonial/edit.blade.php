@extends('layout.admin-app')
@section('title_text', 'Create Testimonial')
@section('page_title', 'Create Testimonial')
@section('content')
<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Create Testimonial</h3>
                        <div class="card-tools">
                            <a href="{{ route('testimonial.index') }}" class="btn btn-primary">Testimonial List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('testimonial.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" name="name" value="{{ old('name',$data->name) }}" class="form-control" id="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="designation" class="form-label">Designation *</label>
                            <input type="text" name="designation" value="{{ old( 'designation',$data->designation) }}" class="form-control" id="designation">
                                @error('designation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea name="description" class="form-control" id="description">{{ old('description', $data->description) }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="photo" class="form-label">Image *</label>
                            <input type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" class="form-control" id="photo">
                            <div class="mt-2">
                                <img id="blah" src="{{ $data->image ? asset($data->image) : "" }}" width="100" height="100" />
                            </div>
                                @error('photo')
                                   <p class="text-danger">{{ $message }}</p>
                                @enderror

                        </div>
                        <div class="form-group mb-3">
                            <label for="visibility" class="form-label">Visibility Status</label><br>
                            <input type="checkbox" name="status" data-toggle="toggle" name="visibility" {{ $data->status == 'on' ? 'checked' : '' }}  data-on="Enabled" data-off="Disabled">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Create New</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @push('js')
    <script>

    </script>
    <script>
        $(document).ready(function() {
            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });
        });
    </script>
    @endpush
