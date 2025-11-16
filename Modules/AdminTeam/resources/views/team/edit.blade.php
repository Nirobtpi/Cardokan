@extends('layout.admin-app')
@section('title_text', 'Team Update')
@section('page_title', 'Update Team')
@section('content')
<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8 offset-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Update Team</h3>
                        <div class="card-tools">
                            <a href="{{ route('adminteam.index') }}" class="btn btn-primary">Team List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('adminteam.update', $adminTeam->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="brand_name" class="form-label">Name *</label>
                            <input type="text" name="name" value="{{ old('name', $adminTeam->name) }}" class="form-control" id="brand_name">
                            <div class="invalid-feedback">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Email *</label>
                            <input type="text" readonly name="email" value="{{ old('email', $adminTeam->email) }}" class="form-control" id="email">
                             <div class="invalid-feedback">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="photo" class="form-label">Image *</label>
                            <input type="file" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" class="form-control" id="photo">
                            <div class="mt-2">
                                <img id="blah" src="{{ asset($adminTeam->photo) }}" width="100" height="100" />
                            </div>
                            <div class="invalid-feedback">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Roles</label>
                            <select name="roles[]" id="roles" multiple class="form-control select2">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option @selected($adminTeam->roles->pluck('id')->contains($role->id)) value="{{ $role->id }}" >{{ $role->name }}</option>

                                @endforeach
                            </select>
                             <div class="invalid-feedback">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="visibility" class="form-label">Visibility Status</label><br>
                            <input type="checkbox" data-toggle="toggle" name="status" @checked($adminTeam->status == 'active') value="1" data-on="Enabled" data-off="Disabled">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @endpush
    @push('js')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });

            $('.select2').select2();

        });
    </script>
    @endpush
