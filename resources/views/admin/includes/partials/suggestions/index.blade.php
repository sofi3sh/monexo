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
                        <div class="col-12">
                            <h3>Модерация "пожеланий и предложений" (идей)</h3>
                        </div>
                    </div>

                    <table class="table table-striped without-datatable text-center">
                        <tbody>
                        @isset($suggestions)
                            @foreach($suggestions as $suggestion)
                                <tr class="py-2">

                                    <td class="text-left pl-2 py-2">
                                        <p class="text-break">
                                            @if($suggestion->title)
                                                {{$suggestion->title}} <br>
                                            @endif
                                            {{$suggestion->text}}
                                        </p>
                                    </td>

                                    <td aria-label="Действие" class="text-nowrap">
                                        @if($suggestion->is_moderated)
                                            <div class="d-inline-block py-2">
                                                <form action="{{ route('admin.suggestions.decline', $suggestion->id) }}" method="POST">
                                                    {{method_field('PATCH')}}
                                                    @csrf
                                                    <input type="submit" class="btn btn-warning btn-sm btn-decline" value="Отклонить">
                                                </form>
                                            </div>
                                        @else
                                            <div class="d-inline-block py-2">
                                                <form action="{{ route('admin.suggestions.apply', $suggestion->id) }}" method="POST">
                                                    {{method_field('PATCH')}}
                                                    @csrf
                                                    <input type="submit" class="btn btn-success btn-sm btn-apply" value="Одобрить">
                                                </form>
                                            </div>
                                        @endif

                                        <div class="d-inline-block py-2">
                                            <form action="{{ route('admin.suggestions.delete', $suggestion->id) }}" method="POST">
                                                {{method_field('DELETE')}}
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$suggestion->id}}">
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

    @include('admin.includes.partials.delete-confirmation', ['item_name' => 'идеи'])
@endsection

@section('scripts')
    @include('admin.includes.partials.suggestionTypes.scripts')
@endsection
