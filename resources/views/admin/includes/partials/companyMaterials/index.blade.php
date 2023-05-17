@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1>Презентационные материалы компании</h1>
        <div class="mb-3">
            <a href="{{route('admin.companyMaterials.companyMaterial.create')}}" class="btn btn-primary ">Создать материал</a>
        </div>
        <table id="company-materials-table" class="table without-datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название материала</th>
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
    @include('admin.includes.partials.companyMaterials.scripts')
@endsection
