{{-- Таблица выполненных выводов --}}
<table>
    <tbody>
    @foreach($view_model->withdrawals as $withdrawals)
        <tr>
            {{-- Дата выполнения транзакции --}}
            <td>
                {{ $withdrawals->created_at }}
            </td>
            {{-- Сумма в криптовалюте --}}
            <td>
                {{ -$withdrawals->amount_crypto }} {{ $withdrawals->wallet->currency->code }}
            </td>
            {{-- Сумма в usd --}}
            <td>
                ${{ -$withdrawals->amount_usd }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>