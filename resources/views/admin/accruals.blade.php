@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>

                <div class="admin-content-block">
            		<h3>Выполненные начисления</h3>
            		
                	@include('admin.includes.partials.accruals')
            	</div>

            </div>
        </div>
    </div>
@endsection