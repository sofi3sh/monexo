@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
{{--        <div class="row">--}}
            <div class="col-sm-6">
                <h3>Шаблон ответов</h3>
                <form method="post"
                      action="{{ route('admin.response-template.store') }}"
                      id="form-response-template"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-inline">
                        <label for="input_id">ID</label>
                        <input type="text"
                               name="id"
                               class="form-control"
                               id="input_id"
                               value="{{$responseTemplate->id ?? ''}}"
                               readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_template" class="">Шаблон</label>
                        <textarea name="template"
                                  class="form-control "
                                  id="input_template"
                                  maxlength="8192"
                                  rows="6">{{$responseTemplate->template ?? ''}}</textarea>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('admin.ticket-support') }}"><button type="button" class="btn btn-outline-primary">Назад</button></a>
                        <button type="submit" class="btn btn-primary" form="form-response-template">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
{{--    </div>--}}
@endsection
