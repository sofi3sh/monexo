{{-- --}}

<form action="{{ route('admin.create-transaction', $user->id) }}" method="POST">
    @csrf
    {{-- Скрытые поля --}}
    <input type="text" class="invisible" name="user_id" value="{{ $user->id }}">

    <div class="row">
        <div class="col-lg-6">
            <label for="created_at">Дата</label>
            <input type="datetime-local" name="created_at" required class="form-control" id="created_at"
                   aria-describedby="emailHelp">
        </div>

        <div class="col-lg-6">
            <label for="transaction_type_id">Тип начисления</label>
            <select name="transaction_type_id" class="calc-block__dropdown form-control"
                    id="transaction_type_id" onchange="transactionTypeOnChange(this.value)">
                @foreach($transaction_types as $transaction_type)
                    <option value="{{ $transaction_type->id }}">{{ $transaction_type->name_ru }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            Можно вводить или "Сумма, $" или "Сумма, крипта".
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="amount_usd">Сумма, $</label>
            <input type="number" step="any" min="0.01" name="amount_usd" class="form-control" id="amount_usd"
                   aria-describedby="emailHelp">
        </div>

        <div class="col-lg-6">
            <label for="amount_crypto">Сумма, крипта</label>
            <input type="number" step="any" min="0.000001" name="amount_crypto" class="form-control"
                   id="amount_crypto"
                   aria-describedby="emailHelp">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <label for="rate">Курс (на дату)</label>
            <input type="number" required step="any" min="0.000001" name="rate" class="form-control" id="rate"
                   aria-describedby="emailHelp">
        </div>
        <div class="col-lg-6">
            <label for="currency">Платежная система</label>
            <select name="currency_id" class="calc-block__dropdown form-control" id="currency">
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}">{{ $currency->name }} ({{ $currency->code }})</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="address">Адрес кошелька</label>
            <input type="text" name="address" class="form-control" id="address" aria-describedby="emailHelp">
        </div>
        <div class="col-lg-6">
            <label for="additional_data">Тэг (при необходимости)</label>
            <input type="text" name="additional_data" class="form-control" id="additional_data"
                   aria-describedby="emailHelp">
        </div>
    </div>
    <div class="row" style="padding-top: 1em">
        <div class="col-lg-12">
            <button type="submit" class="login-page__submit login-block__submit button">
                Создать
            </button>
        </div>
    </div>
</form>
