@extends('auth.layout')

@section('content')
    <div class="login-wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Проверка Google 2FA</div>
                    <div class="panel-body">
                        <strong>Введите пароль с приложения Google Authenticator</strong><br/><br/>
                        <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                            @csrf
                            <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="one_time_password" class="col-lg-12 control-label">Одноразовый
                                        пароль</label>
                                    <div class="col-lg-10">
                                        <input name="one_time_password" class="form-control" type="text" required/>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 1em">
                                    @include('includes.partials.messages')
                                </div>
                                <div class="row" style="padding-top: 2em">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="input-row">
                                            <button type="submit" class="button button--middle">Войти</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection