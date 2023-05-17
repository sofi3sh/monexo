@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block admin-content-block--no-table-radius">
                    <h3 class="h3 mb-3">Добавление/Редактирование вопросов для MLM UP 2.0</h3>
                    @include('includes.partials.messages')
                    <form method="post"
                          action="{{ route('admin.mlmup2question.store') }}"
                          autocomplete="off"
                          id="form-question"
                          class="form-horizontal">
                        @csrf
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Справочник вопросов MLM UP 2.0</h4>
                                <p class="card-category">Добавление/Редактирование</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input
                                        name="id"
                                        id="input-id"
                                        type="hidden"
                                        readonly
                                        value="{{ $question->id ?? '' }}"/>
                                </div>
                                <div class="row">
                                    <div class="input-group form-group required">
                                        <label
                                            class="col-sm-2 col-form-label input-group-addon"
                                            for="select-module_id"
                                        >Название модуля*</label>
                                        <div class="col-sm-2">
                                            <select id="select-module_id"
                                                    name="module_id"
                                                    required
                                                    class="selectpicker form-control"
                                                    data-style="btn btn-primary btn-round">
                                                <option disabled selected>Выберите из списка</option>
                                                @foreach($listModule as $key => $value)
                                                    <option value="{{$key}}"
                                                            @if(isset($question) &&
                                                                $question->module_id === $key
                                                                ) selected @endif>
                                                        {{$value}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 form-control-text">Вопрос*</label>
                                    <div class="col-sm-7">
                                            <input
                                                name="question"
                                                class="form-control"
                                                id="input-question"
                                                type="text"
                                                placeholder="Вопрос"
                                                value="{{ $question->question ?? '' }}"
                                                required="true"
                                                maxlength="2048"
                                                aria-required="true"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex ml-auto mr-auto">
                                    <button type="submit" form="form-question" class="btn btn-primary mr-3">Сохранить</button>
                                    <a href="{{ route('admin.mlmup2question') }}" class="btn btn-secondary d-block" role="button">Назад</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
