@extends('layout.admin-app')
@section('title_text', 'Admin Profile')
@section('page_title', 'Admin Profile')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div> 

                    {{ $data }}
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" id="current_password">
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
