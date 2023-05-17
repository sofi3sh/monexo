@extends('layouts.admin')


@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <div class="container-fluid">
        <h1 class="h4 text-center mb-3">{{$title}}</h1>
        <form action="{{route('admin.withdrawal-regulations.limits.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-5">
                    <select id="select-limit" class="form-control mb-3" name="id">
                        @foreach ($limits as $limit)
                            <option data-limit={{$limit->value}} value="{{$limit->id}}">{{$limit->name}}</option>
                        @endforeach
                    </select>
                    <label for="value">Ограничение в $</label>
                    <input value={{$limits[0]->value}} id="value" type="text" class="form-control mb-3" name="value">
                </div>
            </div>
           
            <button type="submit" class="btn btn-dark">Сохранить</button>            
            <a href="{{route('admin.withdrawal-regulations.index')}}" class="btn btn-secondary">Назад</a>            
        </form>
    </div>
@endsection

@section('scripts')
    <script>

        $('#select-limit')
            .on('change', function(e) {
                const limit = $(this).find(':selected').data('limit')
                $('#value').val(limit);
        });

    </script>
@endsection