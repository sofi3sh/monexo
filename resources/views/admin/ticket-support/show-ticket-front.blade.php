@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="col-sm-6">
            <h3>Тикет с фронта</h3>
            <form method="post"
                  action="{{ route('admin.ticket-front.store') }}"
                  id="form-template-front"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group form-inline">
                    <label for="input_id">ID</label>
                    <input type="text"
                           name="id"
                           class="form-control"
                           id="input_id"
                           value="{{$ticketFront->id ?? ''}}"
                           readonly>
                </div>
                <div class="form-group form-inline">
                    <label for="input_full_name">Имя:</label>
                    <input type="text"
                           name="full_name"
                           class="form-control"
                           id="input_full_name"
                           value="{{$ticketFront->full_name ?? ''}}"
                           readonly>
                </div>
                <div class="form-group form-inline">
                    <label for="input_email">Email:</label>
                    <input type="text"
                           name="email"
                           class="form-control"
                           id="input_email"
                           value="{{$ticketFront->email ?? ''}}"
                           readonly>
                </div>
                <div class="form-group">
                    <label for="input_question" class="">Вопрос</label>
                    <textarea name="question"
                              class="form-control "
                              id="input_question"
                              readonly
                              rows="6">{{$ticketFront->question ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="input_answer" class="">Ответ</label>
                    <textarea name="answer"
                              class="form-control "
                              id="input_answer"
                              maxlength="4092"
                              @if( ! is_null($ticketFront->answer)) readonly @endif
                              rows="6">{{$ticketFront->answer ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <a href="{{ route('admin.ticket-support') }}"><button type="button" class="btn btn-outline-primary">Назад</button></a>
                    @if( is_null($ticketFront->answer))
                    <button type="submit" class="btn btn-primary" form="form-template-front">Сохранить</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection

