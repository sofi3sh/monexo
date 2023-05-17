@extends('layouts.admin')

@section('css')
    <style>
        .btn {
            width: initial !important;
        }

        button.btn.btn-success {
            color: white !important;
            background-color: #28a745 !important;
        }

        button.btn.btn-success:hover {
            background-color: #1E7E3A !important;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid px-5 pb-5">
        <div class="d-flex">
            <form class="mr-1" action="{{route('admin.global-actions.up')}}" method="POST">
                @csrf
                <button type="submit" id="site-up" class="btn btn-success">Поднять сайт</button>
            </form>
            <form action="{{route('admin.global-actions.down')}}" method="POST">
                @csrf
                <button type="submit" id="site-down" class="btn btn-danger">Положить сайт</button>
            </form>
        </div>
        
    </div>
@endsection


