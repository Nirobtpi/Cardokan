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
                    <form action="{{ route('car.update',$car->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="purpose" class="form-label">Purpose: *</label>
                            <select class="form-select" id="purpose" name="purpose">
                                <option @selected($car->purpose == 'rent') value="rent">Rent</option>
                                <option @selected($car->purpose == 'sale') value="sale">sale</option>
                            </select>
                            @error('purpose')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="dealer" class="form-label">Dealer *</label>
                            <select class="form-select" id="dealer" name="dealer">
                                <option value="">Choose...</option>
                                @foreach ($users as $user)
                                <option @selected($user->id == $car->user_id) value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
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
                                    <input type="text" value="{{ $car->name }}" name="title" class="form-control" id="title">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="slug" class="form-label">Slug *</label>
                                    <input type="text" value="{{ $car->slug }}" name="slug" class="form-control" id="slug">
                                    @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="car_image" class="form-label">Car Image <small class="text-danger">if upload new image give image here</small></label>
                            <input type="file" name="car_image" class="form-control" id="car_image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img class="mt-2" id="blah" src="{{ $car->image ? asset($car->image) : "" }}" style="60px;height:60px" alt="carimage">
                            @error('car_image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="brands" class="form-label">Brand *</label>
                                    <select class="form-select" id="brand" name="brand">
                                        <option value="">Choose...</option>
                                        @foreach ($brands as $brand)
                                        <option @selected($brand->id == $car->brand_id) value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="country" class="form-label">Country *</label>
                                    <select class="form-select" id="country" name="country">
                                        <option value="">Choose...</option>
                                        @foreach ($countries as $country)
                                        <option @selected($country->id == $car->country_id) value="{{ $country->id }}">{{ $country->name }}</option>
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
                                         <option @selected($city->id == $car->city_id) value="{{ $city->id }}">{{ $city->name }}</option>   
                                    </select>
                                    @error('city')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <label for="rent_period" class="form-label">Rent Period *</label>
                                    <select class="form-select" id="rent_period" name="rent_period">
                                        <option value="">Choose...</option>
                                        <option value="hourly" @selected($car->rent_period == 'hourly') >Hourly</option>
                                        <option value="monthly" @selected($car->rent_period == 'monthly')>Monthly</option>
                                        <option value="yearly" @selected($car->rent_period == 'yearly')>Yearly</option>
                                        <option value="daily" @selected($car->rent_period == 'daily')>Daily</option>
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
                                    <input type="text" value="{{ $car->price }}" name="regular_price" class="form-control" id="regular_price">
                                    @error('regular_price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="offer_price" class="form-label">Offer Price</label>
                                    <input type="text" value="{{ old('offer_price',$car->offer_price) }}" name="offer_price" class="form-control" id="offer_price">
                                    @error('offer_price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" name="description" id="description"
                                aria-label="With textarea">{!! $car->description !!}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="row mb-4">
                            <h2 class="card-title mb-4">Key Information</h2>
                            <hr>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="seller_type" class="form-label">Seller Type: *</label>
                                        <select class="form-select" id="seller_type" name="seller_type">
                                            <option value="">Choose...</option>
                                            <option @selected($car->seller_type == 'dealer') value="dealer">Dealer</option>
                                            <option @selected($car->seller_type == 'indivisual') value="indivisual">Indivisual</option>
                                        </select>
                                        @error('seller_type')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="body_type" class="form-label">Body Type: *</label>
                                        <input type="text" value="{{ $car->body_type }}" name="body_type" class="form-control" id="body_type">
                                        @error('body_type')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="engine_size" class="form-label">Engine Size: *</label>
                                        <input type="text" value="{{ $car->engine_size }}" name="engine_size" class="form-control" id="engine_size">
                                        @error('engine_size')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="drive" class="form-label">Drive: *</label>
                                        <input type="text" value="{{ $car->drive }}" name="drive" class="form-control" id="drive">
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
                                        <input type="text" value="{{ $car->interior_color }}" name="interior_color" class="form-control"
                                            id="interior_color">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="exterior_color" class="form-label">Exterior Color:</label>
                                        <input type="text" value="{{ $car->exterior_color }}" name="exterior_color" class="form-control"
                                            id="exterior_color">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="year" class="form-label">Year:</label>
                                        <input type="text" value="{{ $car->year }}" name="year" class="form-control" id="year">
                                        @error('year')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="mileage" class="form-label">Mileage: *</label>
                                        <input type="text" value="{{ $car->mileage }}" name="mileage" class="form-control" id="mileage">
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
                                        <input type="text" value="{{ $car->total_owner }}" name="total_owner" class="form-control" id="total_owner">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="fuel_type" class="form-label">Fuel Type: *</label>
                                        <input type="text" value="{{ $car->fuel_type }}" name="fuel_type" class="form-control" id="fuel_type">
                                        @error('fuel_type')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="transmission" class="form-label">Transmission</label>
                                        <input type="text" value="{{ $car->transmission }}" name="transmission" class="form-control" id="transmission">
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="car_model" class="form-label">Car Model *</label>
                                        <input type="text" value="{{ $car->car_model }}" name="car_model" class="form-control" id="car_model">
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
                                    <input {{ $car->features->contains($feature->id) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="{{ $feature->id }}"
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
