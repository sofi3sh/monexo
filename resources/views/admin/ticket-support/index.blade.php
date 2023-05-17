@extends('layouts.admin')

@section('scripts')
    <script src="{{ asset('js/ticket/responsible.js') }}" defer></script>
@endsection

@section('css')
    <style>
        #table th, #table td, #table a, #table button {
            font-size: 14px !important;
        }

        #table th, #table td {
            padding: 10px 5px !important;
        }
    </style>
@endsection

@section('content')
    @include('admin.ticket-support.modal-responsible ')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session('status'))
                    <div class="alert alert-primary">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div>
                    Непрочитанных сообщений (без тикетов с фронта): {{$not_viewed_count}}
                </div>

                <div class="admin-content-block">
                    <h3>Тикеты</h3>

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-fresh-tab" data-toggle="pill" href="#pills-fresh" role="tab" aria-controls="pills-fresh" aria-selected="true">Новый</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-active-tab" data-toggle="pill" href="#pills-active" role="tab" aria-controls="pills-active" aria-selected="false">Активный</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-close-tab" data-toggle="pill" href="#pills-close" role="tab" aria-controls="pills-close" aria-selected="false">Закрыт</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-response-ticket-tab" data-toggle="pill" href="#pills-response-ticket" role="tab" aria-controls="pills-response-ticket" aria-selected="false">Шаблоны ответов</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-ticket-support-tab" data-toggle="pill" href="#pills-ticket-support" role="tab" aria-controls="pills-ticket-support" aria-selected="false">Тикеты с фронта</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-fresh" role="tabpanel" aria-labelledby="pills-fresh-tab">
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th>Действие</th>
                                            <th>ID</th>
                                            <th>Тема</th>
                                            <th>Текст</th>
                                            <th>Прикрепления</th>
                                            <th>Имя пользователя</th>
                                            <th>Почта пользователя</th>
                                            <th>Номер телефона</th>
                                            <th>Ответственный</th>
                                            <th>Создано</th>
                                            <th>Дата создания</th>
                                            <th>Удаление</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($listTicketFresh)
                                            @foreach($listTicketFresh as $ticket)
                                                <tr>
                                                    <td aria-label="Действие">
                                                        <a href="{{ route('admin.ticket-support.edit', $ticket['id']) }}" class="btn btn-sm">✏️</a>
                                                    </td>
                                                    <td aria-label="id">{{ $ticket['id'] }}</td>
                                                    <td aria-label="Тема">{{$ticket['theme']}}</td>
                                                    <td aria-label="Текст">{{$ticket->question_short}}</td>
                                                    <td aria-label="Прикрепления">{{$ticket['attachment_count']}}</td>
                                                    <td aria-label="Имя пользователя">{{$ticket['author_name']}}</td>
                                                    <td aria-label="Почта пользователя">{{$ticket['author_email']}}</td>
                                                    <td aria-label="Номер телефона">{{$ticket['author_phone']}}</td>
                                                    <td aria-label="Ответственный"><button class="btn btn-default button-responsible" id="responsible-{{$ticket['id']}}">{{$ticket['responsible']}}</button></td>
                                                    <td aria-label="Дата создания">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ticket->created_at)->diffForHumans()}}</td>
                                                    <td aria-label="Создано">{{$ticket->created_at}}</td>
                                                    <td>
                                                        <div style="display: flex; align-items: center;">
                                                            <form method="post"
                                                                  action="{{ route('admin.ticket-support.destroy', $ticket['id']) }}"
                                                                  onsubmit="return confirm('Удалить ?');">
                                                                @csrf
                                                                <button type="submit" class="btn">🗑️</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="pills-active" role="tabpanel" aria-labelledby="pills-active-tab">
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th>Действие</th>
                                        <th>ID</th>
                                        <th>Непрочитанных</th>
                                        <th>Тема</th>
                                        <th>Текст</th>
                                        <th>Прикрепления</th>
                                        <th>Имя пользователя</th>
                                        <th>Почта пользователя</th>
                                        <th>Номер телефона</th>
                                        <th>Ответственный</th>
                                        <th>Удаление</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($listTicketActive)
                                        @foreach($listTicketActive as $ticket)
                                            <tr>
                                                <td aria-label="Действие"><a href="{{route('admin.ticket-support.edit', $ticket['id'])}}" class="btn btn-sm">✏️</a></td>
                                                <td aria-label="id">{{ $ticket['id'] }}</td>
                                                <td aria-label="Непрочитанных">{{ $ticket->admin_not_viewed }}</td>
                                                <td aria-label="Тема">{{$ticket['theme']}}</td>
                                                <td aria-label="Текст">{{$ticket->question_short}}</td>
                                                <td aria-label="Прикрепления">{{$ticket['attachment_count']}}</td>
                                                <td aria-label="Имя пользователя">{{$ticket['author_name']}}</td>
                                                <td aria-label="Почта пользователя">{{$ticket['author_email']}}</td>
                                                <td aria-label="Номер телефона">{{$ticket['author_phone']}}</td>
                                                <td aria-label="Ответственный"><button class="btn btn-default button-responsible" id="responsible-{{$ticket['id']}}">{{$ticket['responsible']}}</button></td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <form method="post"
                                                              action="{{ route('admin.ticket-support.destroy', $ticket['id']) }}"
                                                              onsubmit="return confirm('Удалить ?');">
                                                            @csrf
                                                            <button type="submit" class="btn">🗑️</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="pills-close" role="tabpanel" aria-labelledby="pills-close-tab">
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th>Действие</th>
                                        <th>ID</th>
                                        <th>Тема</th>
                                        <th>Текст</th>
                                        <th>Прикрепления</th>
                                        <th>Имя пользователя</th>
                                        <th>Почта пользователя</th>
                                        <th>Номер телефона</th>
                                        <th>Ответственный</th>
                                        <th>Удаление</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($listTicketClose)
                                        @foreach($listTicketClose as $ticket)
                                            <tr>
                                                <td aria-label="Действие"><a href="{{route('admin.ticket-support.edit', $ticket['id'])}}" class="btn btn-sm">✏️</a></td>
                                                <td aria-label="id">{{ $ticket['id'] }}</td>
                                                <td aria-label="Тема">{{$ticket['theme']}}</td>
                                                <td aria-label="Текст">{{$ticket->question_short}}</td>
                                                <td aria-label="Прикрепления">{{$ticket['attachment_count']}}</td>
                                                <td aria-label="Имя пользователя">{{$ticket['author_name']}}</td>
                                                <td aria-label="Почта пользователя">{{$ticket['author_email']}}</td>
                                                <td aria-label="Номер телефона">{{$ticket['author_phone']}}</td>
                                                <td aria-label="Ответственный"><button class="btn btn-default button-responsible" id="responsible-{{$ticket['id']}}">{{$ticket['responsible']}}</button></td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <form method="post"
                                                              action="{{ route('admin.ticket-support.destroy', $ticket['id']) }}"
                                                              onsubmit="return confirm('Удалить ?');">
                                                            @csrf
                                                            <button type="submit" class="btn">🗑️</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="pills-response-ticket" role="tabpanel" aria-labelledby="pills-response-ticket-tab">
                            <a class="btn btn-primary btn-sm mb-4" href="{{ route('admin.response-template.create') }}">Создать шаблон</a>
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>Редактироват</th>
                                        <th>ID</th>
                                        <th>Текст</th>
                                        <th>Дата создания</th>
                                        <th>Дата редактирования</th>
                                        <th>Удалить</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @isset($listResponseTemplate)
                                    @foreach($listResponseTemplate as $responseTemplate)
                                        <tr>
                                            <td aria-label="Редактировать"><a href="{{route('admin.response-template.edit', $responseTemplate['id'])}}" class="btn btn-sm">✏️</a></td>
                                            <td aria-label="id">{{ $responseTemplate['id'] }}</td>
                                            <td aria-label="Текст">{{ $responseTemplate['template'] }}</td>
                                            <td aria-label="Дата создания">{{ $responseTemplate['created_at'] }}</td>
                                            <td aria-label="Дата редактирования">{{ $responseTemplate['updated_at'] }}</td>
                                            <td>
                                                <form method="post"
                                                        action="{{ route('admin.response-template.destroy', $responseTemplate['id']) }}"
                                                        onsubmit="return confirm('Вы действительно хотите удалить шаблон ответа?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm">🗑️️</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade show" id="pills-ticket-support" role="tabpanel" aria-labelledby="pills-ticket-support-tab">
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th>Редактироват</th>
                                        <th>ID</th>
                                        <th>Имя</th>
                                        <th>Email</th>
                                        <th>Телефон</th>
                                        <th>Вопрос</th>
                                        <th>Ответ</th>
                                        <th>Дата создания</th>
                                        <th>Дата редактирования</th>
                                        <th>Удалить</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @isset($listTicketFront)
                                        @foreach($listTicketFront as $ticketFront)
                                            <tr>
                                                <td aria-label="Редактировать"><a href="{{route('admin.ticket-front.edit', $ticketFront['id'])}}" class="btn btn-sm">✏️</a></td>
                                                <td aria-label="id">{{ $ticketFront['id'] }}</td>
                                                <td aria-label="Имя">{{ $ticketFront['full_name'] }}</td>
                                                <td aria-label="Email">{{ $ticketFront['email'] }}</td>
                                                <td aria-label="Телефон">{{ $ticketFront['phone'] }}</td>
                                                <td aria-label="Вопрос">{{ $ticketFront['question'] }}</td>
                                                <td aria-label="Ответ">{{ $ticketFront['answer'] }}</td>
                                                <td aria-label="Дата создания">{{ $ticketFront['created_at'] }}</td>
                                                <td aria-label="Дата редактирования">{{ $ticketFront['updated_at'] }}</td>
                                                <td>
                                                    <form method="post"
                                                          action="{{ route('admin.ticket-front.destroy', $ticketFront['id']) }}"
                                                          onsubmit="return confirm('Вы действительно хотите удалить шаблон ответа?');">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm">🗑️️</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
