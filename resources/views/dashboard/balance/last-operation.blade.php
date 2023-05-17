<div class="card">


    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">@lang('base.dash.balance.history.title')</h3>
            </div>
            <div class="col text-right">
                <a href="{{ route('home.alerts') }}" class="btn btn-sm btn-primary">@lang('base.dash.balance.history.more')</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
            <tr>
                <th scope="col">@lang('base.dash.balance.history.date')</th>
                <th scope="col">@lang('base.dash.balance.history.system')</th>
                <th scope="col">@lang('base.dash.balance.history.amount')</th>
                <th scope="col">@lang('base.dash.balance.history.operation')</th>
                <th scope="col">@lang('base.dash.balance.history.status')</th>
                <th scope="col">@lang('base.dash.balance.history.action')</th>
            </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr class="{{$payment->address_status}}">
                        <td>{{$payment->created_at}}</td>
                        <td>{{$payment->currency->name}}</td>
                        <td>{{$payment->amount_currency}}</td>
                        <td>{{$payment->type_operation}}</td>
                        <td>{{$payment->status_all_operation}}</td>
{{--                        <td>{{$payment->status_operation_lang}}</td>--}}
                        <td>@if ($payment->button_continue == 1) <a href="{{ route('home.balance.button-continue', ['id' => $payment->id]) }}" class="btn btn-primary" >@lang('base.dash.balance.history.proceed')</a>@endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
