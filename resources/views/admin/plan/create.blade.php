@extends('layout.admin-app')
@section('title_text', 'Add Plan')
@section('page_title', 'Add Plan')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Plan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('plan.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Plan Name *</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Plan Name *</label>
                            <input type="number" name="price" class="form-control" id="price">
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="expiration_date" class="form-label">Expiration Date *</label>
                            <select class="form-select" id="expiration_date" name="expiration_date">
                                <option value="lifetime">Lifetime</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                            @error('expiration_date')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="maximum_cars" class="form-label">Maximum Car *</label>
                            <input type="number" name="maximum_cars" class="form-control" id="maximum_cars">
                            @error('maximum_cars')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="features_car" class="form-label">Featured Car *</label>
                            <input type="number" name="features_car" class="form-control" id="features_car">
                            @error('features_car')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="serial" class="form-label">Serial *</label>
                            <input type="number" name="serial" class="form-control" id="serial">
                            @error('serial')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-check form-switch mb-3">
                            <label class="form-label d-black" for="status">Visibility Status</label>
                            <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" >

                        </div>
                        <div class="from-grop">
                            <button class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @push('js')

    @endpush
