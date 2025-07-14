@extends('layout.admin-app')
@section('title_text', 'Car Create')
@section('page_title', 'Car Create')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Car</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="purpose" class="form-label">Purpose: *</label>
                            <select class="form-select" id="purpose" name="purpose">
                                <option selected="" value="">Choose...</option>
                                <option value="rent">Rent</option>
                                <option value="sale">sale</option>
                            </select>
                            @error('purpose')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="dealer" class="form-label">Dealer *</label>
                            <select class="form-select" id="dealer" name="dealer">
                                <option selected="" value="">Choose...</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                                @endforeach

                            </select>
                            @error('dealer')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="title" class="form-label">Title *</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="slug" class="form-label">Slug *</label>
                                    <input type="text" name="slug" class="form-control" id="slug">
                                    @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="car_image" class="form-label">Car Image *</label>
                             <input type="file" name="car_image" class="form-control" id="car_image">
                             @error('car_image')
                                 <p class="text-danger">{{ $message }}</p>
                             @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="brands" class="form-label">Brand *</label>
                                    <select class="form-select" id="brand" name="brand">
                                        <option selected="" value="">Choose...</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="country" class="form-label">Country *</label>
                                    <select class="form-select" id="country" name="country">
                                        <option selected="" value="">Choose...</option>
                                        @foreach ($counties as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="city" class="form-label">City *</label>
                                    <select class="form-select" id="city" name="city">
                                        <option selected="" value="">Choose...</option>
                                    </select>
                                    @error('city')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="rent_period" class="form-label">Rent Period *</label>
                                    <select class="form-select" id="rent_period" name="rent_period">
                                        <option selected="" value="">Choose...</option>
                                        <option value="hourly">Hourly</option>
                                        <option value="daily">Daily</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                    </select>
                                    @error('rent_period')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="regular_price" class="form-label">Regular Price *</label>
                                    <input type="text" name="regular_price" class="form-control" id="regular_price">
                                    @error('regular_price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="offer_price" class="form-label">Offer Price</label>
                                    <input type="text" name="offer_price" class="form-control" id="offer_price">
                                    @error('offer_price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" name="description" id="description"
                                aria-label="With textarea"></textarea>
                        </div>


                        <div class="row mb-4">
                            <h2 class="card-title mb-4">Key Information</h2>
                            <hr>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="seller_type" class="form-label">Seller Type: *</label>
                                        <select class="form-select" id="seller_type" name="seller_type">
                                            <option selected="" value="">Choose...</option>
                                            <option value="dealer">Dealer</option>
                                            <option value="indivisual">Indivisual</option>
                                        </select>
                                        @error('seller_type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="body_type" class="form-label">Body Type: *</label>
                                        <input type="text" name="body_type" class="form-control" id="body_type">
                                         @error('body_type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="engine_size" class="form-label">Engine Size: *</label>
                                        <input type="text" name="engine_size" class="form-control" id="engine_size">
                                         @error('engine_size')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="drive" class="form-label">Drive: *</label>
                                        <input type="text" name="drive" class="form-control" id="drive">
                                         @error('drive')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="interior_color" class="form-label">Interior Color</label>
                                        <input type="text" name="interior_color" class="form-control"
                                            id="interior_color">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="exterior_color" class="form-label">Exterior Color:</label>
                                        <input type="text" name="exterior_color" class="form-control" id="exterior_color">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="year" class="form-label">Year:</label>
                                        <input type="text" name="year" class="form-control" id="year">
                                        @error('year')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="mileage" class="form-label">Mileage: *</label>
                                        <input type="text" name="mileage" class="form-control" id="mileage">
                                        @error('mileage')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="total_owner" class="form-label">Number of Owner</label>
                                        <input type="text" name="total_owner" class="form-control" id="total_owner">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="fuel_type" class="form-label">Fuel Type: *</label>
                                        <input type="text" name="fuel_type" class="form-control" id="fuel_type">
                                        @error('fuel_type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="transmission" class="form-label">Transmission</label>
                                        <input type="text" name="transmission" class="form-control" id="transmission">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="car_model" class="form-label">Car Model *</label>
                                        <input type="text" name="car_model" class="form-control" id="car_model">
                                        @error('car_model')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <h2 class="card-title mb-4">Features</h2>
                            <hr>
                            <div class="col-lg-12">
                                @foreach ($features as $feature)
                                <div class="form-check d-inline-block me-3 mb-2">
                                    <input class="form-check-input" type="checkbox" value="{{ $feature->id }}"
                                        name="feature[]" id="{{ $feature->name }}">
                                    <label class="form-check-label" for="{{ $feature->name }}">
                                        {{ $feature->name }}
                                    </label>
                                </div>
                                @endforeach
                                @error('feature')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

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
        @foreach($errors -> all() as $error)
        toastr.error('{{ $error }}', 'Error');
        @endforeach

        $(document).ready(function () {
            $('#description').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#title').on('keyup', function () {
                let val = $(this).val();
                let slug = val.toLowerCase().toLowerCase().replace(/\s+/g, '-').replace(/--+/g, '-')
                    .replace(/^-+|-+$/g, '');
                $('#slug').val(slug);
            });

            $('#country').on('click', function () {
                let id = $(this).val();
                let url = "{{ route('ajax.city',':id') }}";
                $.ajax({
                    url: url.replace(':id', id),
                    type: "GET",
                    success: function (response) {
                        console.log(response);
                        let html = $('#city');
                        html.empty();
                        html.append('<option value="">Select City</option>');
                        $.each(response, function (index, city) {
                            html.append(
                                `<option value="${city.id}">${city.name}</option>`
                                );
                        })
                    }
                });
            })
        });

    </script>
    @endpush
