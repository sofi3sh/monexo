@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>

                @if(session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                <div class="admin-content-block">
                    <h3 class="mb-3">Партнеры</h3>

                    <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.partner.create') }}">Создать партнера</a>

                    <table id="partners-table" class="table without-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Фамилия</th>
                                <th>Город</th>
                                <th>Телефон</th>
                                <th>Телеграм</th>
                                <th>Дата рождения</th>
                                <th>Создан</th>
                                <th>Изменен</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.includes.partials.partners.scripts')
@endsection
