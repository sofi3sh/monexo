@extends('layouts.app')

@section('content')
    @include('includes.partials.messages')

    <div class="row">
        <div class="col-lg-12">
            Всего инвестировано: ${{ -$total_invested_to_marketplace }}
            <form method="POST" action="{{ route('home.marketplace.invest') }}">
                @csrf
                Сумма инвестирования, $
                <input class="{{ $errors->has('sum') ? ' is-invalid' : '' }}" type="number" name="sum"
                       value="{{ old('sum') }}" required>
                @if ($errors->has('sum'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sum') }}</strong>
                        </span>
                @endif
                <button type="submit">Инвестировать</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table" id="table">
                <thead>
                <tr>
                    <th class="text-center">Дата</th>
                    <th class="text-center">Сумма</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invests as $invest)
                    <tr>
                        <td>{{ $invest->created_at }}</td>
                        <td>${{ -$invest->amount_usd }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection