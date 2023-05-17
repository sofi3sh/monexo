@extends('auth.layout', ['title' => __('auth.header.login')])
@section('content')
    <!-- Page content -->
    <div class="container mt-8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>@lang('base.withdrawal_title')</small>
                        </div>
                        @if(session()->has('alert-error'))
                            <div class="alert alert-danger">
                                {{ session()->get('alert-error') }}
                            </div>
                        @endif
                        <form role="form" action="/withdraw_verification" method="POST" id="withdraw-form">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative {{ $errors->any() ? ' has-error' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" name="code" required placeholder="@lang('base.withdraw_code')" value="" type="text">
                                </div>
                                @if ($errors->any())
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first() }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button id="withdraw-submit" type="submit" class="btn btn-primary my-4">@lang('base.withdraw_button')</button>
                                <a href="{{route('home.main')}}">@lang('base.withdrawal_back')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('withdraw-form').onsubmit = function () {
            document.getElementById('withdraw-submit').disabled = true;
        };
    </script>
@endsection
