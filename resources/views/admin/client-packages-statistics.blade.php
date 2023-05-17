{{-- Статистика по пакетам --}}
@extends('layouts.admin')


@section('content')

    <div class="container-fluid">
        <a href="{{route('admin.client', ['id' => $user])}}" class="btn btn-primary">Назад</a>
        <div class="p-3">
            Общий долг в структуре: ${{$debt}}
            @foreach ($packagesStatistics as $title => $package)
                <div>
                    <b>{{$title}}</b>
                    @foreach($package as $key => $value)
                    {{-- 0 элемент - количество пакетов для него не нужен $ --}}

                        <p>
                            @if($loop->index !== 0)$@endif
                            {{$key}}: {{$value}}
                        </p>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

@endsection
