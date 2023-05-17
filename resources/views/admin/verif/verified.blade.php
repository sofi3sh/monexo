@extends('layouts.admin')

@section('css')
    <style>
        .btn {
            width: initial !important;
        }
        button.btn.btn-success {
            color: white !important;
            background-color: #28a745 !important;
        }
        
        button.btn.btn-success:hover {
            background-color: #1E7E3A !important;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid px-5">
        <h1>Анкеты на верификацию аккаунта</h1>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                        <th>User ID</th>
                        <th>Пользователь</th>
                        <th>Email</th>
                        <th>Мультиаккаунты?</th>
                        <th>Информация если создавал</th>
                        <th>Дополнительная информация</th>
                        <th>Действия</th>
                </thead>        
                <tbody>
                    @foreach ($ankets as $anket)
                        <tr>
                            <td>{{$anket->user->id}}</td>
                            <td>
                                <b>В системе:</b><br>
                                {{$anket->user->name . ' ' . $anket->user->surname}} <br>
                                {{$anket->user->phone}} <br>
                                <b>Из анкеты:</b> <br>
                                {{$anket->name . ' ' . $anket->surname}} <br>
                            </td>
                            <td>{{$anket->user->email}}</td>
                            <td>{{$anket->multi_accounts}} </td>
                            <td></td>
                            <td>
                               
                            </td>
                            <td>
                                <div class="d-flex">
                                    <form action="{{route('admin.verif.verife')}}" method="POST" style="margin-right: 5px">
                                        @csrf
                                        @method('PATCH')
                                        <input name="id" type="hidden" value="{{$anket->id}}">
                                        <button type="submit" class="btn btn-success">Верифицировать</button>
                                    </form>
                                    <form action="{{route('admin.verif.refuse')}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input name="id" type="hidden" value="{{$anket->id}}">
                                        <button type="submit" class="btn btn-danger">Отказать</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        
    </div>
@endsection