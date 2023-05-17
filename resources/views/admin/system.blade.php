@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
            @include('admin.includes.partials.system.accruals_params')
            </div>
        </div>
    </div>
@endsection