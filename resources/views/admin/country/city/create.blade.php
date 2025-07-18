@extends('layout.admin-app')
@section('title_text', 'Add City')
@section('page_title', 'Add City')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add City</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('city.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">City Name *</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div  class="form-group mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country" name="country">
                                <option selected="" value="">Choose...</option>
                                @foreach ($countries as $country)
                                      <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
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
