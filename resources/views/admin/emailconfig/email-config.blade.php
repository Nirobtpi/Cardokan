@extends('layout.admin-app')
@section('title_text', 'Email Configration')
@section('page_title', 'Email Configration')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Email Configuration</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.email.update',$emailOption->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="sender_name" class="form-label">Sender Name</label>
                            <input type="text" name="sender_name" class="form-control" id="sender_name" value="{{ $emailOption->sender_name }}" placeholder="CarDokan">
                        </div>
                        <div class="form-group mb-3">
                            <label for="mailer_name" class="form-label">Mailer Name</label>
                            <input type="text" name="mailer_name" class="form-control" id="mailer_name" value="{{ $emailOption->mailer_name }}" placeholder="smtp">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Host Email</label>
                            <input type="text" name="host_email" class="form-control" id="email" value="{{ $emailOption->host_email }}" placeholder="smtp.gmail.com">
                        </div>
                        <div class="form-group mb-3">
                            <label for="mail_host" class="form-label">Mail User Name</label>
                            <input type="text" name="mail_user_name" class="form-control" id="mail_host" value="{{ $emailOption->mail_user_name }}" placeholder="test@gmail.com">
                        </div>
                        <div class="form-group mb-3">
                            <label for="smtp_user_name" class="form-label">Mail From Address</label>
                            <input type="text" name="mail_from_address" class="form-control" value="{{ $emailOption->mail_from_address }}" id="smtp_user_name" placeholder="abc@gmail.com">
                        </div>
                        <div class="form-group mb-3">
                            <label for="smtp_password" class="form-label">SMTP Password</label>
                            <input type="text" name="smtp_password" class="form-control" value="{{ $emailOption->mail_password }}" id="smtp_password" placeholder="abcdefgdh">
                        </div>
                        <div class="form-group mb-3">
                            <label for="mail_port" class="form-label">Mail Port</label>
                            <input type="text" name="mail_port" class="form-control" value="{{ $emailOption->mail_port }}" id="mail_port" placeholder="587">
                        </div>
                        <div class="form-group mb-3">
                            <label for="mail_encryption" class="form-label">Mail Encryption</label>
                            <select class="form-select" id="mail_encryption" name="mail_encryption">
                                <option @selected($emailOption->mail_encryption == 'tls') value="tls">TLS</option>
                                <option @selected($emailOption->mail_encryption == 'ssl') value="ssl">SSL</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @push('js')
   
    @endpush
