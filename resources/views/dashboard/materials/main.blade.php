@extends('dashboard.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/materials.css')}}">
    <style>
        
        .title {
            color: #000;
            font-size: 28px;
        }

        .share__list {
            list-style-type: none;
            padding-left: 0;
        }
        
    </style>
@endsection

@section('content')
    
    @include('dinway.chunks.companyMaterials')
    
@endsection