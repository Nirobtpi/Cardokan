@extends('layout.admin-app')
@section('title_text', 'Create Brand')
@section('page_title', 'Create Brand')
@section('content')
{{-- saba sara saaasdafsdkf --}}
{{-- nuirbdfkjsbsdfjvbkf --}}
<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Create Brand</h3>
                        <div class="card-tools">
                            <a href="{{ route('brand.index') }}" class="btn btn-primary">Car List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="brand_name" class="form-label">Name *</label>
                            <input type="text" name="brand_name" value="{{ old('brand_name') }}" class="form-control" id="brand_name">
                            <div class="invalid-feedback">
                                @error('brand_name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Slug *</label>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" id="slug">
                             <div class="invalid-feedback">
                                @error('slug')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="photo" class="form-label">Image *</label>
                            <input type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" class="form-control" id="photo">
                            <div class="mt-2">
                                <img id="blah" width="100" height="100" />
                            </div>
                            <div class="invalid-feedback">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group mb-3">
                            <label for="visibility" class="form-label">Visibility Status</label><br>
                            <input type="checkbox" data-toggle="toggle" name="visibility" value="1" data-on="Enabled" data-off="Disabled">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Create Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @push('js')
    <script>
        @foreach($errors -> all() as $error)
        toastr.error('{{ $error }}', 'Error');
        @endforeach
    </script>
    <script>
        $(document).ready(function() {
            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });
            function makeSlug(text){
                return text
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/--+/g, '-'); 
            }
            $('#brand_name').on('keyup',function(){
                const name = $(this).val();
                const slug = makeSlug(name);
                $('#slug').val(slug);
            })
        });
    </script>
    @endpush
