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
                    <h3 class="mb-3">FAQ</h3>

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-questions-tab" data-toggle="pill" href="#pills-questions" role="tab" aria-controls="pills-questions" aria-selected="true">Вопросы</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pills-categories-tab" data-toggle="pill" href="#pills-categories" role="tab" aria-controls="pills-categories" aria-selected="false">Категории</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-questions" role="tabpanel" aria-labelledby="pills-questions-tab">
                            <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.faq.question.create') }}">Создать вопрос</a>

                            <table id="faq-questions-table" class="table without-datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Категория</th>
                                        <th>Создан</th>
                                        <th>Изменен</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="pills-categories" role="tabpanel" aria-labelledby="pills-categories-tab">
                            <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.faq.category.create') }}">Создать категорию</a>

                            <table id="faq-categories-table" class="table without-datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Создана</th>
                                        <th>Изменена</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.includes.partials.faq.scripts')
@endsection
