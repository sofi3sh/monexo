@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="admin-content-block admin-content-block--no-table-radius">
            <h3 class="h2 mb-3">Вопросы для MLM UP 2.0</h3>
            @include('includes.partials.messages')
            <div class="card-actions ml-auto mr-auto mb-3">
                <a href="{{route('admin.mlmup2question.create')}}"
                    class="btn btn-primary"
                    role="button">Добавить</a>
            </div>
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">Редактировать</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Номер модуля</th>
                        <th class="text-center">Вопрос</th>
                        <th class="text-center">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listQuestion as $question)
                        <tr>
                            <td>
                                <a href="{{ route('admin.mlmup2question.edit', ['$question' => $question->id]) }}"
                                   type="button"
                                   class="btn btn-primary btn-link btn-sm">
                                    <i>Редактировать</i>
                                </a>
                            </td>
                            <td>{{$question->id}}</td>
                            <td>{{$question->module_description}}</td>
                            <td>{{$question->question}}</td>
                            <td>
                                <form action="{{ route('admin.mlmup2question.destroy', ['$question' => $question->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            rel="tooltip"
                                            title="Удалить"
                                            class="btn btn-danger btn-link btn-sm">
                                        <i class="material-icons">Удалить</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
