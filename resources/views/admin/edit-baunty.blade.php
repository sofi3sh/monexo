@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @include('includes.partials.messages')
        <div class="row">
            <div class="col-lg-12">
                <br>
                <div class="admin-content-block">
                    <h3>Редактировать Baunty <a style="box-shadow:inset 0 0 15px black;padding:5px 10px;line-height:1;font-size: 16px;color:red;" href="{{route('home.baunty')}}" target="_blank">пред. просмотр</a></h3>

                    <form action="{{ route('admin.storeBaunty') }}" method="POST">
                        @csrf
                        {{-- Скрытые поля --}}
                        <input type="text" class="invisible" name="id"  value="{{ $baunty->id }}">
                        {{-- Дата --}}
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="created_at">Дата создания{{ is_null($baunty)?Carbon::now()->format('d/m/Y'):$baunty->created_at->format('d/m/Y') }}</label>
                            </div>
                        </div>

                        {{-- Заголовок --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="header">Заголовок</label>
                                <input type="text" name="header" class="form-control" id="header"
                                       value="{{ $baunty->title }}">
                            </div>
                        </div>

                        {{-- Текст --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="text">Текст</label><br>
                                <textarea class="form-control summernote" id="text" name="text" rows="10"
                                          cols="60">{{ $baunty->text}}</textarea>
                            </div>
                        </div>

                        {{-- Кнопка --}}
                        <div class="input-row">
                            {{-- Сообщения --}}
                            @include('includes.partials.messages')
                            <button type="submit" class="button settings-profile--submit-button">Сохранить</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
