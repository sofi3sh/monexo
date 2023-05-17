@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                @if(session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                <div class="admin-content-block admin-content-block--no-table-radius">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3>Типы "пожеланий и предложений" (идей)</h3>
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-success btn-sm" href="{{route('admin.suggestion-types.create')}}">Содзать</a>
                        </div>
                    </div>

                    <table class="table table-striped without-datatable text-center">
                        <tbody>
                        @isset($suggestionTypes)
                            @foreach($suggestionTypes as $suggestionType)
                                <tr class="py-2">
                                    <td class="text-left pl-2 py-2">{{ $suggestionType->title_ru }} / {{ $suggestionType->title_en }}</td>

                                    <td aria-label="Действие">
                                        <div class="d-inline-block">
                                            <a class="btn btn-success btn-sm mr-1" href="{{route('admin.suggestion-types.edit', $suggestionType->id)}}">Редактировать</a>
                                        </div>

                                        <div class="d-inline-block">
                                            <form action="{{ route('admin.suggestion-types.delete', $suggestionType->id) }}" method="POST">
                                                {{method_field('DELETE')}}
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$suggestionType->id}}">
                                                    Удалить
                                                </button>
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
        </div>
    </div>

    @include('admin.includes.partials.delete-confirmation', ['item_name' => 'типа идеи'])
@endsection

@section('scripts')
    @include('admin.includes.partials.suggestionTypes.scripts')
@endsection
