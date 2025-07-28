@extends('frontend.master')
@section('title_text', 'CarDokan - Car Dealer Laravel Website')
@section('content')
            <!-- Banner area start -->
            <section class="rts-banner-area bg_image_one jarallax">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-area-one bg_image">
                                <div class="banner-content-area">
                                    <div class="pre-title wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">
                                        <span>{{ __('Shop With Confidence – Quality Vehicles') }}</span>
                                    </div>
                                    <h1 class="title wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">Discover
                                        {{ __('Our Best Deals On
                                        New And Used') }} <span>Cars</span></h1>
                                    <div class="select-area-down wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1s">
                                        <form action="#" method="get" accept-charset="utf-8">
                                            <select name="my_select" class="mySelect">
                                                <option value="2" selected>Car Make</option>
                                                <option value="10">Mazda</option>
                                                <option value="1">Citroen</option>
                                                <option value="13">Honda</option>
                                                <option value="14">Mitsubishi</option>
                                                <option value="15">Peugeot</option>
                                            </select>
                                        </form>
                                        <form class="select-2" action="#" method="get" accept-charset="utf-8">
                                            <select name="my_select2" class="my_select2">
                                                <option value="2" selected>Car Model</option>
                                                <option value="10">155</option>
                                                <option value="1">151</option>
                                                <option value="13">150</option>
                                                <option value="14">152</option>
                                                <option value="15">156</option>
                                            </select>
                                        </form>
                                        <form class="select-2" action="#" method="get" accept-charset="utf-8">
                                            <select name="my_select2" class="my_select2">
                                                <option value="2" selected>Price</option>
                                                <option value="10">22,000$</option>
                                                <option value="1">27,000$</option>
                                                <option value="13">30,000$</option>
                                                <option value="14">32,000$</option>
                                                <option value="15">38,000$</option>
                                            </select>
                                        </form>
                                        <button type="submit" class="rts-btn radius-big icon btn-primary">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.69 10.69L13 13M12.3333 6.68575C12.3333 9.826 9.796 12.3715 6.667 12.3715C3.53725 12.3715 1 9.826 1 6.6865C1 3.54475 3.53725 1 6.66625 1C9.796 1 12.3333 3.5455 12.3333 6.68575Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Banner area end -->

            <!-- Category Area Start -->
            <section class="rts-category-area rts-section-gap">
                <div class="container">
                    <div class="section-title-area">
                        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">{{ __('Car Category') }}</p>
                        <h2 class="section-title wow move-right">{{ __('Browse By') }} <span>{{ __('Car') }}</span> {{ __('Type') }}</h2>
                    </div>
                    <div class="section-inner wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="swiper category-slider">
                            <div class="swiper-wrapper">
                                @foreach ($categories as $category)
                                <div class="swiper-slide">
                                    <div class="category-wrapper">
                                        <div class="icon">
                                            <img src="{{ asset($category->brand_logo) }}" alt="">
                                        </div>
                                        <h6 class="title"><a href="#">{{ $category->brand_name }}</a></h6>
                                        <p class="desc">{{ $category->cars_count }}+ Car</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-shape-area">
                    <img src="{{ asset('frontend/assets/images/category/shape/shape-01.svg') }}" alt="">
                    <img src="{{ asset('frontend/assets/images/category/shape/shape-02.svg') }}" alt="">
                </div>
            </section>
            <!-- Category Area End -->

            <!-- Portfolio Area Start -->
            <section class="rts-portfolio-area rts-section-gap">
                <div class="section-title-area2">
                    <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">{{ __('Select Car') }}</p>
                    <h2 class="section-title wow move-right">{{ __('Our Amazing') }} <span>{{ __('Car') }}</span></h2>
                </div>
                <div class="tab-area">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="new-cars-tab" data-bs-toggle="tab" data-bs-target="#new-cars" type="button" role="tab" aria-controls="new-cars" aria-selected="true">{{ __('All Cars') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="used-tab" data-bs-toggle="tab" data-bs-target="#used" type="button" role="tab" aria-controls="used" aria-selected="false">{{ __('New Cars') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="trending-tab" data-bs-toggle="tab" data-bs-target="#trending" type="button" role="tab" aria-controls="trending" aria-selected="false">{{ __('Used Cars') }}</button>
                        </li>
                    </ul>
                </div>
                <div class="section-inner mt--80 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                    <div class=" tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="new-cars" role="tabpanel" aria-labelledby="new-cars-tab">
                            <div class="slider-area">
                                <div class="swiper projectSlider">
                                    <div class="swiper-wrapper">
                                        @foreach ($cars as $car)
                                        <div class="swiper-slide">
                                            <div class="project-wrapper">
                                                <div class="image-area">
                                                    <a href="portfolio-details.html">
                                                        <img src="{{ asset($car->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <span class="price">{{ $car->price }}$</span>
                                                <div class="content-area">
                                                    <h5 class="title"><a href="portfolio-details.html">{{ $car->name }}</a>
                                                    </h5>
                                                    <ul class="feature-area">
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/01.svg') }}" alt="">
                                                            {{ $car->mileage }} Miles
                                                        </li>
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/02.svg') }}" alt="">
                                                            {{ $car->fuel_type }}
                                                        </li>
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/03.svg') }}" alt="">
                                                            {{ $car->transmission }}
                                                        </li>
                                                    </ul>
                                                    <a href="portfolio-details.html" class="rts-btn btn-primary radius-big">View
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="used" role="tabpanel" aria-labelledby="used-tab">
                            <div class="slider-area">
                                <div class="swiper projectSlider">
                                    <div class="swiper-wrapper">
                                        @foreach ($new_cars as $car)
                                        <div class="swiper-slide">
                                            <div class="project-wrapper">
                                                <div class="image-area">
                                                    <a href="portfolio-details.html">
                                                        <img src="{{ asset($car->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <span class="price">{{ $car->price }}$</span>
                                                <div class="content-area">
                                                    <h5 class="title"><a href="portfolio-details.html">{{ $car->name }}</a>
                                                    </h5>
                                                    <ul class="feature-area">
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/01.svg') }}" alt="">
                                                            {{ $car->mileage }} Miles
                                                        </li>
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/02.svg') }}" alt="">
                                                            {{ $car->fuel_type }}
                                                        </li>
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/03.svg') }}" alt="">
                                                            {{ $car->transmission }}
                                                        </li>
                                                    </ul>
                                                    <a href="portfolio-details.html" class="rts-btn btn-primary radius-big">View
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="trending" role="tabpanel" aria-labelledby="used-tab">
                            <div class="slider-area">
                                <div class="swiper projectSlider">
                                    <div class="swiper-wrapper">
                                        @foreach ($used_cars as $car)
                                        <div class="swiper-slide">
                                            <div class="project-wrapper">
                                                <div class="image-area">
                                                    <a href="portfolio-details.html">
                                                        <img src="{{ asset($car->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <span class="price">{{ $car->price }}$</span>
                                                <div class="content-area">
                                                    <h5 class="title"><a href="portfolio-details.html">{{ $car->name }}</a>
                                                    </h5>
                                                    <ul class="feature-area">
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/01.svg') }}" alt="">
                                                            {{ $car->mileage }} Miles
                                                        </li>
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/02.svg') }}" alt="">
                                                            {{ $car->fuel_type }}
                                                        </li>
                                                        <li>
                                                            <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/03.svg') }}" alt="">
                                                            {{ $car->transmission }}
                                                        </li>
                                                    </ul>
                                                    <a href="portfolio-details.html" class="rts-btn btn-primary radius-big">View
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Portfolio Area End -->

            <!-- About Area Start -->
            <section class="rts-about-area rts-section-gapBottom">
                <div class="container">
                    <div class="section-inner">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="about-image-area">
                                    <div class="image-main">
                                        <img class="wow scaleIn" data-wow-delay=".5s" data-wow-duration="1.5s" src="{{ asset('frontend/assets/images/about/03.webp') }}" width="371" alt="">
                                        <div class="counter-area">
                                            <div class="inner wow zoomIn" data-wow-delay=".9s" data-wow-duration="1s">
                                                <h2 class="title"><span class="counter">{{ __('1000') }}</span><span>+</span></h2>
                                                <p class="desc">{{ __('Car Sold Already') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{ asset('frontend/assets/images/about/01.webp') }}" alt="" width="223" class="floating-img-01 wow scaleIn" data-wow-delay=".5s" data-wow-duration="1.5s">
                                    <img src="{{ asset('frontend/assets/images/about/02.webp') }}" alt="" width="266" class="floating-img-02 wow scaleIn" data-wow-delay=".5s" data-wow-duration="1.5s">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="about-content-area">
                                    <div class="section-title-area">
                                        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">About
                                            Us</p>
                                        <h2 class="section-title wow move-right">{{ __('Driven by Excellence: Your Trusted Partner
                                            for Premium') }}
                                            <span>{{ __('Vehicles')}}</span>
                                        </h2>
                                    </div>
                                    <p class="desc">{{ __('Welcome to Autovault where innovation drives every journey. Discover a
                                        range of designed to elevate your driving experience.') }}</p>
                                    <a href="about.html" class="rts-btn btn-primary radius-big">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About Area End -->

            <!-- Video Area Start -->
            <div class="rts-video-area bg-video-five bg_image jarallax">

                <video muted loop id="myVideo">
                    <source src="{{ asset('frontend') }}/assets/images/portfolio/video-01.webm">
                </video>
                <div class="content">
                    <button id="myBtn"></button>
                </div>
            </div>
            <!-- Video Area End -->

            <!-- Brand Area Start -->
            <section class="rts-brand-area rts-section-gap">
                <div class="container">
                    <div class="section-title-area2">
                        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration="1s">Car Brand</p>
                        <h2 class="section-title wow move-right">Our Premium <span>Brands</span></h2>
                    </div>
                    <div class="section-inner mt--80">
                        <ul>
                            <li class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s"><img src="{{ asset('frontend/assets/images/brand/01-w.s') }}vg" alt=""></li>
                            <li class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s"><img src="{{ asset('frontend/assets/images/brand/02.svg') }}" alt=""></li>
                            <li class="wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s"><img src="{{ asset('frontend/assets/images/brand/03.svg') }}" alt=""></li>
                            <li class="wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1s"><img src="{{ asset('frontend/assets/images/brand/04.svg') }}" alt=""></li>
                            <li class="wow fadeInUp" data-wow-delay="1s" data-wow-duration="1s"><img src="{{ asset('frontend/assets/images/brand/05.svg') }}" alt=""></li>
                            <li class="wow fadeInUp" data-wow-delay="1.2s" data-wow-duration="1s"><img src="{{ asset('frontend/assets/images/brand/06.svg') }}" alt=""></li>
                            <li class="wow fadeInUp" data-wow-delay="1.4s" data-wow-duration="1s"><img src="{{ asset('frontend/assets/images/brand/07.svg') }}" alt=""></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- Brand Area End -->

            <!-- Why Choose Us Area End -->
            <section class="rts-why-choose-us">
                <div class="right-image jarallax jara-mask-1">
                    <img src="{{ asset('frontend/assets/images/about/why-choose-bg.webp') }}" width="886" class="jarallax-img" alt="">
                </div>
                <div class="container">
                    <div class="section-inner">
                        <div class="row justify-content-end">
                            <div class="col-lg-6">
                                <div class="content-area">
                                    <div class="section-title-area">
                                        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">Why
                                            Choose Us</p>
                                        <h2 class="section-title cw wow move-right">Why Choose
                                            <span>Us</span>
                                        </h2>
                                    </div>
                                    <ul class="why-choose-feature-list mt--60">
                                        <li class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">
                                            <div class="icon"><img src="{{ asset('frontend/assets/images/why-choose/icon-01.svg') }}" alt=""></div>
                                            <div class="content">
                                                <h6 class="title cw">Competitive Pricing</h6>
                                                <p class="desc">Whether you're looking for a brand-new model or a certified
                                                    pre-owned vehicle, we have a diverse.</p>
                                            </div>
                                        </li>
                                        <li class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">
                                            <div class="icon"><img src="{{ asset('frontend/assets/images/why-choose/icon-02.svg') }}" alt=""></div>
                                            <div class="content">
                                                <h6 class="title cw">24 Hour Support</h6>
                                                <p class="desc">Whether you're looking for a brand-new model or a certified
                                                    pre-owned vehicle, we have a diverse.</p>
                                            </div>
                                        </li>
                                        <li class="wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s">
                                            <div class="icon"><img src="{{ asset('frontend/assets/images/why-choose/icon-03.svg') }}" alt=""></div>
                                            <div class="content">
                                                <h6 class="title cw">GPS on Every Vehicle</h6>
                                                <p class="desc">Whether you're looking for a brand-new model or a certified
                                                    pre-owned vehicle, we have a diverse.</p>
                                            </div>
                                        </li>
                                        <li class="wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1s">
                                            <div class="icon"><img src="{{ asset('frontend/assets/images/why-choose/icon-04.svg') }}" alt=""></div>
                                            <div class="content">
                                                <h6 class="title cw">Expert Maintenance</h6>
                                                <p class="desc">Whether you're looking for a brand-new model or a certified
                                                    pre-owned vehicle, we have a diverse.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Why Choose Us Area End -->

            <!-- Feature Area Start -->
            <section class="rts-feature-area rts-section-gap">
                <div class="container">
                    <div class="section-title-area2">
                        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">Featured Car</p>
                        <h2 class="section-title wow move-right">Our Featured <span>Car</span></h2>
                    </div>
                    <div class="slider-area mt--80 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="swiper featureSlider">
                            <div class="swiper-wrapper">
                                @foreach ($feature_car as $car)
                                <div class="swiper-slide">
                                    <div class="feature-wrapper">
                                        <div class="image-area">
                                            <img src="{{ asset($car->image) }}" width="961" alt="">
                                        </div>
                                        <div class="content-area">
                                            <span class="dot"></span>
                                            <h6 class="title"><a href="portfolio-details.html">{{ $car->name }}</a></h6>
                                            <ul class="feature-area">
                                                <li>
                                                    <img src="{{ asset('frontend/assets/images/portfolio/feature-icon/01.svg') }}" alt="">
                                                    {{ $car->mileage }} Miles
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/03.svg" alt="">
                                                    {{ $car->transmission }}
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/04.svg" alt="">
                                                    {{ $car->total_owner }} Person
                                                </li>
                                            </ul>
                                            <a href="portfolio-details.html" class="rts-btn radius-big">View
                                                Details</a>
                                        </div>
                                        <img src="{{ asset('frontend/assets/images/feature/round-shape.svg') }}" alt="" class="shape">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination-3"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Feature Area End -->

            <!-- Testimonials Area Start -->
            <section class="rts-testimonials-area rts-section-gap">
                <div class="container">
                    <div class="section-title-area">
                        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">Testimonial</p>
                        <h2 class="section-title wow move-right">What Our <span>Client</span> Says
                        </h2>
                    </div>
                    <div class="section-inner mt--80">
                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-5 col-lg-6 wow fadeIn" data-wow-delay=".2s" data-wow-duration="1s">
                                <div class="left-side-image text-end">
                                    <img src="assets/images/testimonials/02.webp" width="423" alt="" class="main-image wow scaleIn" data-wow-delay=".5s" data-wow-duration="1.5s">
                                    <img src="assets/images/testimonials/01.webp" width="373" alt="" class="floating-img wow scaleIn" data-wow-delay=".5s" data-wow-duration="1.5s">
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6">
                                <div class="slider-inner">
                                    <div class="swiper testimonialSlider">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="review-wrapper">
                                                    <ul class="star-rating">
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star-sharp-half-stroke"></i></li>
                                                    </ul>
                                                    <p class="desc">
                                                        Choosing Bokinn was one of the best decisions we've ever made. They
                                                        have proven to be a reliable and innovative partner, always ready to
                                                        tackle new challenges with and expertise.Their commitment to and
                                                        delivering tailored.
                                                    </p>
                                                    <div class="author-area">
                                                        <h6 class="title">Sarah Martinez</h6>
                                                        <p class="designation">CEO of Apex Solutions</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="review-wrapper">
                                                    <ul class="star-rating">
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star-sharp-half-stroke"></i></li>
                                                    </ul>
                                                    <p class="desc">
                                                        Choosing Bokinn was one of the best decisions we've ever made. They
                                                        have proven to be a reliable and innovative partner, always ready to
                                                        tackle new challenges with and expertise.Their commitment to and
                                                        delivering tailored.
                                                    </p>
                                                    <div class="author-area">
                                                        <h6 class="title">Xavi Alonso</h6>
                                                        <p class="designation">CEO of Apex Solutions</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="review-wrapper">
                                                    <ul class="star-rating">
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star-sharp-half-stroke"></i></li>
                                                    </ul>
                                                    <p class="desc">
                                                        Choosing Bokinn was one of the best decisions we've ever made. They
                                                        have proven to be a reliable and innovative partner, always ready to
                                                        tackle new challenges with and expertise.Their commitment to and
                                                        delivering tailored.
                                                    </p>
                                                    <div class="author-area">
                                                        <h6 class="title">Jamal Musiala</h6>
                                                        <p class="designation">Founder of Apex Solutions</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="review-wrapper">
                                                    <ul class="star-rating">
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star-sharp-half-stroke"></i></li>
                                                    </ul>
                                                    <p class="desc">
                                                        Choosing Bokinn was one of the best decisions we've ever made. They
                                                        have proven to be a reliable and innovative partner, always ready to
                                                        tackle new challenges with and expertise.Their commitment to and
                                                        delivering tailored.
                                                    </p>
                                                    <div class="author-area">
                                                        <h6 class="title">Xavi Alonso</h6>
                                                        <p class="designation">CEO of Apex Solutions</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="review-wrapper">
                                                    <ul class="star-rating">
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star"></i></li>
                                                        <li><i class="rt-icon-star-sharp-half-stroke"></i></li>
                                                    </ul>
                                                    <p class="desc">
                                                        Choosing Bokinn was one of the best decisions we've ever made. They
                                                        have proven to be a reliable and innovative partner, always ready to
                                                        tackle new challenges with and expertise.Their commitment to and
                                                        delivering tailored.
                                                    </p>
                                                    <div class="author-area">
                                                        <h6 class="title">Jamal Musiala</h6>
                                                        <p class="designation">Founder of Apex Solutions</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-shape-area">
                    <img src="assets/images/category/shape/shape-01.svg" alt="">
                </div>
            </section>
            <!-- Testimonials Area End -->

            <!-- Blog Area Start -->
            <section class="rts-blog-area rts-section-gapTop">
                <div class="container">
                    <div class="section-inner">
                        <div class="row align-items-center">
                            <div class="col-xl-4">
                                <div class="left-side-content">
                                    <div class="section-title-area">
                                        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">
                                            Latest Blog</p>
                                        <h2 class="section-title wow move-right">Our Latest <span>Blog</span></h2>
                                    </div>
                                    <p class="desc wow fadeIn" data-wow-delay=".3s" data-wow-duration="1s">Welcome to
                                        Autovault where innovation drives every journey. Discover a range of designed to
                                        elevate your driving experience.</p>
                                    <a href="blog.html" class="text-btn wow fadeIn" data-wow-delay=".5s" data-wow-duration="1s">Read All Blog</a>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="right-side-blog wow fadeInRight" data-wow-delay=".6s" data-wow-duration="1s">
                                    <div class="row g-5">
                                        @foreach ($blogs as $blog)
                                        <div class="col-lg-6">
                                            <div class="blog-wrapper">
                                                <div class="image-area">
                                                    <a href="blog-details.html"><img src="{{ asset($blog->image) }}" alt=""></a>
                                                </div>
                                                <div class="content">
                                                    <p class="blog-meta">{{ $blog->created_at->format('F d,Y') }}</p>
                                                    <h6><a href="blog-details.html">{{ $blog->title }}</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Blog Area End -->

            <div class="rts-cta-area">
                <div class="container">
                    <div class="cta-inner">
                        <h2 class="title">If you have any questions Please Call.</h2>
                        <div class="contact">
                            <a href="call-to_%2b16544521505.html">
                                <img src="assets/images/cta/call.svg" alt="">
                                +1-654-452-1505</a>
                        </div>
                        <img class="shape one" src="assets/images/cta/round.svg" alt="">
                        <img class="shape two" src="assets/images/cta/line.svg" alt="">
                    </div>
                </div>
            </div>

@endsection
