{{-- Таблицы транзакций --}}
<div class="base-table base-table_wrapper">
    <table>
        <thead>
            <tr>
                <th>@lang('cabinet_plans.transaction.name')</th>
                <th>@lang('cabinet_plans.transaction.amount')</th>
                <th>@lang('cabinet_plans.transaction.start')</th>
                <th>@lang('cabinet_plans.transaction.end')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marketingPlans->get() as $marketingPlan)
                <tr>
                    {{-- План --}}
                    <td aria-label="@lang('cabinet_plans.transaction.name')">
                        <span>{{ $marketingPlan->marketingPlan()->first()->name }}</span>
                    </td>

                    {{-- Депозит --}}
                    <td aria-label="@lang('cabinet_plans.transaction.amount')">
                        <span>{{ number_format(abs($marketingPlan->invested_usd), 2) }}</span>
                    </td>

                    {{-- Дата начала --}}
                    <td aria-label="@lang('cabinet_plans.transaction.start')">
                        <span>{{ $marketingPlan->start_at }}</span>
                    </td>

                    {{-- Дата окончания --}}
                    <td aria-label="@lang('cabinet_plans.transaction.end')">
                        <span>{{ $marketingPlan->end_at }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>