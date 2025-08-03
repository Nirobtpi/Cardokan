@props(['name'])
<!-- rts breadcrumb area start -->
            <div class="rts-breadcrumb-area portfolio jarallax">
                <div class="container">
                    <div class="breadcrumb-area-wrapper">
                        <h1 class="title">{{ $name }}</h1>
                        <div class="nav-bread-crumb">
                            <a href="{{ route('home') }}">{{ __('Home') }}</a>
                            <a href="#" class="current">{{ $name }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- rts breadcrumb area end -->
