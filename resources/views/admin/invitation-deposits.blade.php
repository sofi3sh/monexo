@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session('status'))
                    <div class="alert alert-primary">
                        {{ session('status') }}
                    </div>
                @endif

                <br>

                <div class="admin-content-block">
                    <h3>Пригласительные депозиты</h3>

                    <div class="col-12 mb-2 pl-0">
                        <form method="get" action="{{ route('admin.partner.invitation-deposit.index') }}" class="form-inline mt-3">
                            <div class="form-group input-group-sm mb-2 mr-sm-2">
                                <label for="date_from" class="@error('date_from') text-danger @enderror" style="margin-right: 5px; font-weight: 500;">Период с</label>
                                <input type="date" class="form-control @error('date_from') is-invalid @enderror" id="date_from" name="date_from" value="{{ $date_from }}" placeholder="С">
                            </div>

                            <div class="form-group input-group-sm mb-2 mr-sm-2">
                                <label for="date_to" class="@error('date_to') text-danger @enderror" style="margin-right: 5px; font-weight: 500;">по</label>
                                <input type="date" class="form-control @error('date_to') is-invalid @enderror" id="date_to" name="date_to" value="{{ $date_to }}" placeholder="По">
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary mb-2">
                                <span>Показать</span>
                            </button>
                        </form>
                    </div>

                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Отправитель</th>
                                <th class="text-center">Получатель</th>
                                <th class="text-center">Сумма</th>
                                <th class="text-center">Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td aria-label="id">{{ $item['id'] }}</td>
                                    <td aria-label="Отправитель">{{$item['from_user_email']}} ({{ $item['from_user_name'] }})</td>
                                    <td aria-label="Получатель">{{$item['user_email']}} ({{ $item['user_name'] }})</td>
                                    <td aria-label="Сумма">{{ $item['invested_usd'] }}</td>
                                    <td aria-label="Дата">{{ $item['created_at'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
