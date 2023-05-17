{{-- Подшаблон "Переводы между аккаунтами" --}}
<div class="container-fluid">
    <table class="table2">
        <thead>
        <tr class="no-hover">
            <th>Дата</th>
            <th>С аккаунта</th>
            <th>На аккаунт</th>
            <th>Сумма, USD</th>
        </tr>
        </thead>
        <tbody>

        @foreach($transfers as $transaction)
            <tr class="income">
                <td aria-label="Дата">
                    {{ $transaction->created_at }}
                </td>
                <td>
                    <a href="{{ route('admin.client', $transaction->user_id) }}">
                        {{ $transaction->user->email }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.client', $transaction->user_id) }}">
                        {{ $transaction->relatedUser->email }}
                    </a>
                </td>
                <td>
                    {{ number_format(-$transaction->amount_usd, 2) }}$
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>