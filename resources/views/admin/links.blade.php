@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block admin-content-block--no-table-radius">
                    <h3>Ссылки</h3>

                    @include('includes.partials.messages')

                    <table class="table" id="table">
                        <thead>
                        <tr>
                            <th class="text-center">Дата создания</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Пакет</th>
                            <th class="text-center">Ссылка</th>
                            <th class="text-center">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($links as $link)
                            <tr>
                                <td aria-label="Дата создания">{{ $link->created_at->format('d-m-Y H:i') }}</td>
                                <td aria-label="Email">
                                    <a href="{{ route('admin.client', $link->user_id) }}">
                                        {{ (isset($link->user->email)) ? $link->user->email : '' }}
                                    </a>
                                </td>
                                <td aria-label="Пакет">{{ $link->package->name }}</td>
                                <td aria-label="Ссылка"><a href="{{ $link->link }}" title="{{$link->link}}" target="_blank">{{ substr($link->link, 0, 50) }}{{(strlen($link->link) > 50) ? '...' : ''}}</a></td>
                                <td aria-label="Действие">
                                    @if($link->status == 'notexecuted')
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Действие
                                                </button>
                                                <div class="dropdown-menu">
                                                    <form method="POST"
                                                            action="{{ route('admin.confirm.links', $link->id) }}"
                                                            class="login-block__form form--register">
                                                        @csrf
                                                        <button type="submit"
                                                                class="login-page__submit login-block__submit button">
                                                            Подтвердить
                                                        </button>
                                                    </form>

                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <div role="separator" class="dropdown-divider"></div>
                                                    <form method="POST" action="{{ route('admin.cancel.links', $link->id) }}"
                                                            class="login-block__form form--register">
                                                        @csrf
                                                        <button type="submit"
                                                                class="login-page__submit login-block__submit button"
                                                                style="background-color: #ff0b24">
                                                            Удалить
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="{{($link->status == 'accepted') ? 'text-success' : 'text-danger' }}">{{($link->status == 'accepted') ? 'Утверждено' : 'Отклонено' }}</span>
                                    @endif
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