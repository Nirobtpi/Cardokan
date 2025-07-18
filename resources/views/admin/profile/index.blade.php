@extends('layout.admin-app')
@section('title_text', 'Admin Profile')
@section('page_title', 'Admin Profile')
@section('content')

<div class="container">
    <div class="row">
        {{-- start update profile form --}}

        <div class="col-md-8 mb-4">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Profle</h3>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('admin.profile.update',$admin->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $admin->name }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" name="designation" class="form-control" id="designation"
                                value="{{ $admin->designation }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="name" value="{{ $admin->email }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" id="facebook"
                                value="{{ $admin->facebook }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="linkedin" class="form-label">Linkedin</label>
                            <input type="text" name="linkedin" class="form-control" id="linkedin"
                                value="{{ $admin->linkedin }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control" id="twitter"
                                value="{{ $admin->twitter }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control" id="instagram"
                                value="{{ $admin->instagram }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="photo" class="form-label">Profile Picture</label>
                            <input type="file" name="photo" class="form-control mb-2" id="photo"
                                value="{{ $admin->photo }}"
                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                            <img id="blah"
                                src="{{ $admin->photo ? asset($admin->photo) : asset('assets/assets/img/avatar.png') }}"
                                alt="Profile Picture" class="img-thumbnail mt-3"
                                style="max-width: 200px; height: 100px;">
                        </div>
                        <div class="form-group mb-3">
                            <label for="about" class="form-label">About Me</label>
                            <input type="text" name="about_me" class="form-control" id="about"
                                value="{{ $admin->about_me }}">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end profile update form  --}}

        {{-- start change password form --}}
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.profile.change-password', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id="current_password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    @endsection
    @push('js')

    @endpush
