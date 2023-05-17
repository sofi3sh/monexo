@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @include('includes.partials.messages')
        <div class="row">
            <div class="col-lg-12">
                <br>
                <div class="admin-content-block">
                    <h3>Редактировать Новость <a style="box-shadow:inset 0 0 15px black;padding:5px 10px;line-height:1;font-size: 16px;color:red;" href="{{route('website.newsDetails',['id'=>$news->id])}}" target="_blank">пред. просмотр</a></h3>

                    <form action="{{ route('admin.storeNews') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Скрытые поля --}}
                        <input type="text" class="invisible" name="id"  value="{{ $news->id }}">
                        {{-- Дата --}}
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="created_at">Дата создания{{ is_null($news)?Carbon::now()->format('d/m/Y'):$news->created_at->format('d/m/Y') }}</label>
                            </div>
                        </div>

                        {{-- Заголовок --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="header">Заголовок</label>
                                <input type="text" name="header" class="form-control" id="header"
                                       value="{{ $news->header_ru }}">
                            </div>
                        </div>

                        {{-- Изображение с preview новости --}}
                        <div class="row">
                        @if(!is_null($news->thumb))
                        <div class="col-12">
                            <img src="{{asset($news->thumb)}}">
                        </div>
                        @endif
                        <input type="file" name="thumbnails" accept="image/*,image/jpeg">
                        </div>
                        {{-- Краткое описание новости --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="text">Краткое описание новости</label><br>
                                <textarea class="form-control " id="small_text" name="short_description" rows="3" cols="60">{{ $news->short_description_ru }}</textarea>
                            </div>
                        </div>

                        {{-- Текст --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="text">Текст</label><br>
                                <textarea class="form-control summernote" id="text" name="text" rows="10"
                                          cols="60">{{ $news->text_ru }}</textarea>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 300,
                dialogsInBody: true
            });
//            var content =  {!! json_encode($news->text_ru) !!}
//                //set the content to summernote using `code` attribute.
//                $('.summernote').summernote('code', content);
        });
    </script>
    <style>
        .card-block {
            max-width: none;
            border-radius: 0;
            margin: 0;
            display: inline-block;
        }
    </style>
@endsection