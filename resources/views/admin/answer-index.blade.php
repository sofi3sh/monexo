@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block admin-content-block--no-table-radius">
                    <h3>MLM UP 2.0</h3>
                    @include('includes.partials.messages')

                    <div class="row">
                        <div class="col-12 col-lg-7">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @for($i = 0; $i < count($listModules); $i++)
                                    @if($listModules[$i])
                                        <li class="nav-item">
                                            <a class="nav-link @if($i == 0) active @endif" href="#module{{$i + 1}}" id="module{{$i + 1}}-tab" data-toggle="tab" aria-expanded="true">Модуль {{$i + 1}}</a>
                                        </li>
                                    @endif
                                @endfor
                               
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                @for($i = 0; $i < count($listModules); $i++)
                                    @if($listModules[$i])
                                        <div id="module{{$i + 1}}" class="tab-pane fade @if($i == 0) show active @endif" role="tabpanel" aria-labelledby="module{{$i + 1}}">
                                            <h2 class="h2 text-center">Модуль: {{$i + 1}}</h2>
                                            @foreach($listModules[$i] as $module)
                                                <p><b>Вопрос:</b></p>
                                                <p>{{$module->question}}</p>
                                                <p><b>Ответ:</b></p>
                                                <p>{{$module->answer}}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <h3 class="h3">Список пользователей, которые оплатили видеокурс:</h3>
                            <p>Выберите пользователя:</p> 
                            <form class="mb-3" method="post" action="{{route('admin.mlmup2answer')}}" id="form-list-users">
                                @csrf
                                @foreach($listUser as $user)
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <input
                                            name="user_id"
                                            type="radio"
                                            value="{{$user->id}}"
                                            @if($checkedUser == $user->id) checked @endif>
                                        </div>
                                    </div>
                                    <p class="form-control">{{$user->email}}</p> 
                                </div>
                                @endforeach
                                <input class="btn btn-dark d-inline-block mt-3" type="submit" form="form-list-users" value="Просмотреть">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
