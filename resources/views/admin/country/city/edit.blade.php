@extends('layout.admin-app')
@section('title_text', 'Edit City')
@section('page_title', 'Edit City')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit City</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('city.update',$city->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">City Name *</label>
                            <input type="text" name="name" value="{{ $city->name }}" class="form-control" id="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div  class="form-group mb-3"> 
                            <label for="country" class="form-label">Country</label> 
                            <select class="form-select" id="country" name="country">
                                <option selected="" value="">Choose...</option>
                                @foreach ($countries as $country)
                                      <option @selected($country->id == $city->country_id) value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="from-group">
                            <button class="btn btn-primary">Update</button>
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
@endpush
