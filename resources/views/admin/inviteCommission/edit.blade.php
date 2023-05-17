@extends('layouts.admin')

@section('content')
    <div class="alert">
        @if($errors->any())
            @foreach ($errors as $error)
                {{$error}}
            @endforeach
        @endif
    </div>

    <div class="container-fluid">
        <h1 class="h4 text-center">Настройка комиссий для инвайтов, %</h1>
        <form action="{{route('admin.invite-commission.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="hidden" name="id" value="{{ $id ?? null }}">
                <label>Единая комиссия для всех:</label>
                <input name="commission" step="0.1" min="0" max="100" class="form-control" type="number" value="{{$commission}}">
            </div>
            <button type="submit" class="btn btn-dark">Сохранить</button>
            <a href="{{route('admin.invite-commission.index')}}" class="btn btn-secondary">Назад</a>
        </form>
    </div>
@endsection
