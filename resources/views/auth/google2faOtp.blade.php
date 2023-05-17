@extends('auth.layout')

@section('title', 'OTP')

@section('content')
<div class="container pt-8">
    <form method="POST" action="{{ route('otp.check') }}" class="d-flex flex-column align-items-center">
        @csrf
        <label for="otp" class="col-form-label text-md-right text-white text-center">
            @lang('base.2fa.loginCode')
        </label>
        <input id="otp" style="max-width: 280px" 
               type="number" min="0" max="999999" step="1"
               class="form-control{{ $errors->has('otp') ? ' is-invalid' : '' }}"
               autocomplete="off"
               name="otp" value="" required autofocus>

        @if ($errors->has('otp'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('otp') }}</strong>
            </span>
        @endif
        <button type="submit" class="btn btn-white px-4 mt-3">
            Submit
        </button>
    </form>
</div>
@endsection
