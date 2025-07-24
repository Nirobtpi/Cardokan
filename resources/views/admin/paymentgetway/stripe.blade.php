@extends('layout.admin-app')
@section('title_text', 'Stripe Payement Config')
@section('page_title', 'Stripe Payement Config')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Stripe Key Setup</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('stripe.update') }}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="form-group mb-3">
                            <label for="stripe_key" class="form-label">Stripe Key</label>
                            <input type="text" name="stripe_key" value="{{ old('stripe_key', $stripe?->stripe_key) }}" class="form-control" id="stripe_key">
                        </div>
                        <div class="form-group mb-3">
                            <label for="stripe_secret_key" class="form-label">Stripe Secrit Key</label>
                            <input type="text" name="stripe_secret_key" value="{{ old('stripe_secret_key', $stripe?->stripe_secret_key) }}" class="form-control" id="stripe_secret_key">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
 <a href="{{ route('stripe') }}">Pay Stripe</a>
@endsection
@push('js')
<script>


</script>
@endpush
