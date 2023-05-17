@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session('status'))
                    <div class="alert alert-primary">
                        {{ session('status') }}
                    </div>
                @endif

                <br>

                <div class="admin-content-block">
                    <h3>Заявки на статусы</h3>

                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Название статуса</th>
                                <th class="text-center">Статус заявки</th>
                                <th class="text-center">Пользователь</th>
                                <th class="text-center">Регион</th>
                                <th class="text-center">Цена</th>
                                <th class="text-center">Соц. сети</th>
                                <th class="text-center">Коммент.</th>
                                <th class="text-center">Дата</th>
                                <th class="text-center">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td aria-label="id">{{ $item['id'] }}</td>
                                    <td aria-label="Название статуса">{{ $item['status_name'] }}</td>
                                    <td aria-label="Статус заявки">{{ $item['request_status'] }}</td>
                                    <td aria-label="Пользователь">{{ $item['user_name'] }} ({{ $item['user_email'] }})</td>
                                    <td aria-label="Регион">{{ $item['extra_data']['region'] }}</td>
                                    <td aria-label="Цена">{{ $item['extra_data']['price'] }}</td>
                                    <td aria-label="Соц. сети">{{ implode(', ', $item['extra_data']['social_networks']) }}</td>
                                    <td aria-label="Коммент.">{{ $item['extra_data']['comment'] }}</td>
                                    <td aria-label="Дата">{{ $item['created_at'] }}</td>
                                    <td aria-label="Действие">
                                        @if($item['original_request_status'] !== \App\Models\UserStatusRequest::STATUS_WAIT)
                                            -
                                            @continue
                                        @endif

                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Действия
                                                </button>
                                                <div class="dropdown-menu">
                                                    <form method="POST"
                                                          action="{{ route('admin.partner.regional-representative.request.confirm', $item['id']) }}"
                                                          class="login-block__form form--register">
                                                        @csrf
                                                        <button type="submit"
                                                                class="login-page__submit login-block__submit button">
                                                            Подтвердить
                                                        </button>
                                                    </form>

                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <form method="POST" action="{{ route('admin.partner.regional-representative.request.reject', $item['id']) }}"
                                                          class="login-block__form form--register">
                                                        @csrf
                                                        <button type="submit"
                                                                class="login-page__submit login-block__submit button"
                                                                style="background-color: #ff0b24">
                                                            Отклонить
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
