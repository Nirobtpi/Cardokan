@extends('layout.admin-app')
@section('title_text', 'Edit Create')
@section('page_title', 'Edit Create')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Feature</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('feature.update',$feature->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Feature Name *</label>
                            <input type="text" name="name" value="{{ $feature->name }}" class="form-control" id="name">
                            @error('name')
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

@endpush
