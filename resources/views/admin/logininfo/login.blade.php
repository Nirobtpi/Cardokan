<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>CarDokan | Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">
    <meta name="title" content="AdminLTE 4 | Login Page">
    <meta name="author" content="ColorlibHQ">
    <meta name="description"
        content="Cardokan website is a platform for managing car-related services, including car management, user management, subscription plans, KYC management, and more.">
    <meta name="keywords"
        content="car management, user management, subscription plans, KYC management, car services, car-related services, car dealership, car sales, car rental, car maintenance">
    <meta name="supported-color-schemes" content="light dark">
    <link rel="preload" href="{{ asset('assets/css/adminlte.css') }}" as="style">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
</head>

<body class="login-page bg-body-secondary app-loaded">
    <div class="skip-links"><a href="#main" class="skip-link">Skip to main content</a><a href="#navigation"
            class="skip-link">Skip to navigation</a></div>
    <div class="login-box">
        <div class="login-logo"> <a href=""><b>CarDokan</b></a> </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                aria-label="Email">
                            <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                        </div>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                aria-label="Password">
                            <div class="input-group-text"> <span class="bi bi-lock-fill"></span></div>
                        </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--begin::Row-->  
                    <div class="row">
                        <div class="col-4">
                            <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Log In</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->
                </form>

                <div class="social-auth-links text-center mb-3 d-grid gap-2">
                    <p>- OR -</p> <a href="#" class="btn btn-primary"> <i class="bi bi-facebook me-2"></i> Sign in using
                        Facebook
                    </a> <a href="#" class="btn btn-danger"> <i class="bi bi-google me-2"></i> Sign in using Google+
                    </a>
                </div> <!-- /.social-auth-links -->
                <p class="mb-1"> <a href="forgot-password.html">I forgot my password</a> </p>
            </div> <!-- /.login-card-body -->
        </div>
    </div> <!-- /.login-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>

    <script>
        @foreach ($errors->all() as $error)
            toastr.error('{{ $error }}', 'Error');
        @endforeach
       
        // toaster erro show 
        @if(session('message'))

            var type = '{{ session('alert-type', '') }}';

            switch(type){
                case 'success':
                    toastr.success('{{ session('message') }}', 'Success');
                    break;
                case 'error':
                    toastr.error('{{ session('message') }}', 'Error');
                    break;
                case 'warning':
                    toastr.warning('{{ session('message') }}', 'Warning');
                    break;
                case 'info':
                    toastr.info('{{ session('message') }}', 'Info');
                    break;
            }
        @endif
    </script>

    <div id="live-region" class="live-region" aria-live="polite" aria-atomic="true" role="status"></div>
</body>
</html>
