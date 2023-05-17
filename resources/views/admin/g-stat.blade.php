@extends('layouts.admin')

@section('content')
    <h3>Глобальная статистика</h3>
    @include('includes.partials.messages')
    <form action="{{ route('admin.g-stat.update') }}" method="POST" style="padding: 15px;">
        @csrf
        <div class="row">
            <div class="col-lg-3">
                <label for="users_count">Всего людей на проекте</label>
                <input type="number" name="users_count" id="users_count" value={{ $stat[0] }} required
                       class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <label for="deposit">Общий депозит, $</label>
                <input type="number" name="deposit" id="deposit" value={{ $stat[1] }} required class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <label for="profit">Сколько в сумме мы дали дохода, $</label>
                <input type="number" name="profit" id="profit" value={{ $stat[2] }} required class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <label for="withdrawal">Сколько мы выплатили денег, $</label>
                <input type="number" name="withdrawal" id="withdrawal" value={{ $stat[3] }} required
                       class="form-control">
            </div>
        </div>
        
        <br>

        <div class="row">
            <div class="col-lg-6">
                <div class="stats stats--block">
                    <b>Исходя из введенной статистики:</b>
                    <table class="table--border table-main table--not-responsive table--border-grey">
                        <tr>
                            <td>Общая доходность проекта:</td>
                            <td>%{{ number_format(($stat[2]/$stat[1])*100, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Средняя сумма инвестиции одним клиентом</td>
                            <td>${{ number_format($stat[1] / $stat[0], 2) }}</td>
                        </tr>
                        <tr>
                            <td>Средний полученный доход одним клиентом</td>
                            <td>${{ number_format($stat[2] / $stat[0], 2) }}</td>
                        </tr>
                        <tr>
                            <td>Средняя общая выведенная одним клиентом</td>
                            <td>${{ number_format($stat[3] / $stat[0], 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        @if(Auth::user()->email == 'admin@gmail.com' || Auth::user()->email == 'cryptoman@mail.ru')
            <div class="row" style="padding-top: 1em">
                <div class="col-lg-12">
                    <button type="submit" class="login-page__submit login-block__submit button">
                        Обновить
                    </button>
                </div>
            </div>
        @endif
    </form>
@endsection