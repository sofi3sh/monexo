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
        <h1 class="h2 text-center mb-3">Анкеты на верификацию аккаунта</h1>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>User ID</th>
                    <th>Имя и фамилия</th>
                    <th>Email</th>
                    <th>Номер документа</th>
                    <th>Дата создания</th>
                    <th>Решение вынесено?</th>
                </thead>
                <tbody>
                    @foreach ($ankets as $anket)
                        <tr>
                            <td>{{ $anket->user->id }}</td>
                            <td>{{ $anket->name . ' ' . $anket->surname }}</td>
                            <td>
                                <a class="text-primary" href="{{ route('admin.client.verify', $anket->user->email) }}">
                                    {{ $anket->user->email }}
                                </a>
                            </td>
                            <td>{{ $anket->document }}</td>
                            <td>{{$anket->created_at}}</td>
                            <td>{{ $anket->is_check ? 'Да' : 'Нет' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
@endsection
