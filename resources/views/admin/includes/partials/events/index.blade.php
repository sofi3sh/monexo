@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1>События</h1>
        <div class="mb-3">
            <a href="{{route('admin.events.event.create')}}" class="btn btn-primary ">Создать событие</a>
        </div>
        <table id="events-table" class="table without-datatable">
            <thead>
                <tr>
                    <th>ID</th>  
                    <th>Имя события</th>  
                    <th>Дата создания</th>  
                    <th>Дата изменения</th>  
                    <th>Действия</th>  
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @include('admin.includes.partials.events.scripts')
@endsection