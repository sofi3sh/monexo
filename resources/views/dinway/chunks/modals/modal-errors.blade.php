@extends('dinway.chunks.modals.layouts.modal-info')

@section('title')
    @lang('dinway.modals.universe')
@endsection

@section('body')
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endsection
