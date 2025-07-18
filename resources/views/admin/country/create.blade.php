@extends('layout.admin-app')
@section('title_text', 'Add Country')
@section('page_title', 'Add Country')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Country</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('country.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Country Name *</label>
                            <input type="text" name="name" class="form-control" id="name">
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
