@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block">
                    <div class="row">
                        <div class="col-lg-8 text-left">
                        <h3 class="mb-3">Тикет № {{$ticket->id ?? ''}} ({{$ticket->ticketStatus->descr}})</h3>
                        </div>
                        <div class="col-lg-4 text-right">
                            <form method="post"
                                  action="{{ route('admin.ticket-support.change-status') }}"
                                  id="form-status"
                                  enctype="multipart/form-data">
                                <div class="form-row">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                    <div class="col">
                                        @isset($listTicketStatus)
                                            <div class="input-group form-group required">
                                                <label
                                                    class="col-sm-4 col-form-label input-group-addon"
                                                    for="select-status_id"
                                                >Статус</label>
                                                <div class="col-sm-8">
                                                    <select id="select-status_id"
                                                            name="status_id"
                                                            required
                                                            class="selectpicker form-control"
                                                            data-style="btn btn-primary btn-round">
                                                        <option disabled selected>Выберите из списка</option>
                                                        @isset($listTicketStatus)
                                                            @foreach($listTicketStatus as $ticketStatus)
                                                                <option value="{{$ticketStatus->id}}"
                                                                        @if(isset($ticketStatus) && isset($ticket) &&
                                                                            $ticketStatus->id === $ticket->ticket_status_id
                                                                            ) selected @endif>
                                                                    {{$ticketStatus->descr}}
                                                                </option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                        @endisset
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary" form="form-status">Изменить статус</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group form-inline">
                                <label for="input_ticket_user_id" class="col-sm-6">ID пользователя:</label>
                                <input type="text"
                                       name="ticket_user_id"
                                       class="form-control col-sm-6"
                                       id="input_ticket_user_id"
                                       value="{{$ticket->user_id ?? ''}}"
                                       disabled>
                            </div>
                            <div class="form-group form-inline">
                                <label for="input_ticket_user_name" class="col-sm-6">Имя пользователя</label>
                                <input type="text"
                                       name="ticket_user_name"
                                       class="form-control col-sm-6"
                                       id="input_ticket_user_name"
                                       value="{{$ticket->user->surname ?? '' . ' ' . $ticket->user->name}}"
                                       disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-inline">
                                <label for="input_ticket_user_email" class="col-sm-6">Email пользователя</label>
                                <input type="text"
                                       name="ticket_user_email"
                                       class="form-control col-sm-6"
                                       id="input_ticket_user_email"
                                       value="{{$ticket->user->email}}"
                                       disabled>
                            </div>
                            <div class="form-group form-inline">
                                <label for="input_ticket_datetime" class="col-sm-6">Дата и время создания тикета</label>
                                <input type="text"
                                       name="ticket_datetime"
                                       class="form-control col-sm-6"
                                       id="input_ticket_datetime"
                                       value="{{$ticket->created_at}}"
                                       disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="input_ticket_theme" class="">Тема</label>
                                <input type="text"
                                       name="ticket_theme"
                                       class="form-control "
                                       id="input_ticket_theme"
                                       value="{{$ticket->theme ?? ''}}"
                                       disabled>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="input_ticket_appeal_descr" class="">Тип обращения</label>
                                <input type="text"
                                       name="ticket_appeal_descr"
                                       class="form-control "
                                       id="input_ticket_appeal_descr"
                                       value="{{$ticket->appeal->descr ?? ''}}"
                                       disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_ticket_question" class="">Вопрос</label>
                        <textarea name="ticket_question"
                                  class="form-control "
                                  id="input_ticket_question"
                                  readonly rows="6">{{$ticket->question ?? ''}}</textarea>
                    </div>
                    <hr>
                    <h5 class="mb-3">Ответы:</h5>
                    <div class="bg-secondary col-sm-12">
                    @isset($listTicketAnswer)
                        @foreach($listTicketAnswer as $ticketAnswer)
                            <br>
                            <div class="row">
                                <div class="col-sm-3">
                                    Дата и время: {{$ticketAnswer->created_at}}
                                </div>
                                <div class="col-sm-3">
                                    ID пользователя: {{$ticketAnswer->user_id}}
                                </div>
                                <div class="col-sm-3">
                                    Имя пользователя: {{$ticketAnswer->user->name}}
                                </div>
                                <div class="col-sm-3">
                                    Email пользователя: {{$ticketAnswer->user->email}}
                                </div>
                            </div>
                            <textarea class="form-control" disabled rows="3" style="resize: none">{{$ticketAnswer->answer ?? ''}}</textarea>
                        @endforeach
                            <br>
                    @endisset
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
{{--                            <form method="post"--}}
{{--                                  action="{{ route('admin.ticket-support.change-status') }}"--}}
{{--                                  id="form-status"--}}
{{--                                  enctype="multipart/form-data">--}}
{{--                                <div class="form-row">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}">--}}
{{--                                    <div class="col">--}}
{{--                                        @isset($listTicketStatus)--}}
{{--                                            <div class="input-group form-group required">--}}
{{--                                                <label--}}
{{--                                                    class="col-sm-2 col-form-label input-group-addon"--}}
{{--                                                    for="select-status_id"--}}
{{--                                                >Статус*</label>--}}
{{--                                                <div class="col-sm-10">--}}
{{--                                                    <select id="select-status_id"--}}
{{--                                                            name="status_id"--}}
{{--                                                            required--}}
{{--                                                            class="selectpicker form-control"--}}
{{--                                                            data-style="btn btn-primary btn-round">--}}
{{--                                                        <option disabled selected>Выберите из списка</option>--}}
{{--                                                        @isset($listTicketStatus)--}}
{{--                                                            @foreach($listTicketStatus as $ticketStatus)--}}
{{--                                                                <option value="{{$ticketStatus->id}}"--}}
{{--                                                                        @if(isset($ticketStatus) && isset($ticket) &&--}}
{{--                                                                            $ticketStatus->id === $ticket->ticket_status_id--}}
{{--                                                                            ) selected @endif>--}}
{{--                                                                    {{$ticketStatus->descr}}--}}
{{--                                                                </option>--}}
{{--                                                            @endforeach--}}
{{--                                                        @endisset--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endisset--}}
{{--                                    </div>--}}
{{--                                    <div class="col">--}}
{{--                                        <button type="submit" class="btn btn-primary" form="form-status">Изменить статус</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <form method="post"
                                  action="{{ route('admin.ticket-support') }}"
                                  id="form-answer"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="form-group">
                                    <label for="input_answer" class="">Ответ</label>
                                    <textarea name="answer"
                                              class="form-control "
                                              id="input_answer"
                                              rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('admin.ticket-support') }}"><button type="button" class="btn btn-outline-primary">Назад</button></a>
                                    <button type="submit" class="btn btn-primary" form="form-answer">Сохранить</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            @isset($listResponseTemplate)
                                @foreach($listResponseTemplate as $responseTemplate)
                                    <p><input name="radio-template" type="radio" value="{{$responseTemplate->template}}">{{$responseTemplate->template}}</p>
                                @endforeach
                                <p><button id="button-paste-answer" class="btn-primary">Использовать шаблон</button></p>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/ticket/adminPasteTemplate.js') }}" defer></script>
@endsection
