{{--  --}}
<form action="{{ route('admin.create-accruals') }}" method="POST">
    @csrf
    {{-- Скрытые поля --}}
    <input type="text" class="invisible" name="user_id" value="{{ $user->id }}">

    <div class="row">
        <div class="col-lg-12">
            <b>Предварительно должна быть выполнена транзакция "Ввод средств" (одна или несколько), чтобы на "Дата начала" не был нулевой баланс.</b>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <label for="created_at">Дата начала</label>
            <input type="date" name="start_date" required class="form-control" id="start_date">
        </div>

        <div class="col-lg-4">
            <label for="created_at">Дата окончания</label>
            <input type="date" name="end_date" required class="form-control" id="end_date">
        </div>

        <div class="col-lg-4">
            <label for="transaction_type_id">Тип начисления</label>
            <br>Прибыль от инвестиций
        </div>
    </div>

    {{-- --}}
    <div class="row">
        <div class="col-lg-6">
            <label for="amount_usd">Мин. % в день</label>
            <input type="number" step="any" min="0.001" name="min_day_percent" required class="form-control" id="amount_usd">
        </div>

        <div class="col-lg-6">
            <label for="amount_crypto">Макс. % в день</label>
            <input type="number" step="any" min="0.001" name="max_day_percent" required class="form-control">
        </div>
    </div>

    {{-- --}}
    <div class="row" style="padding-top: 1em">
        <div class="col-lg-12">
            <button type="submit" class="login-page__submit login-block__submit button">
                Выполнить начисления за период
            </button>
        </div>
    </div>
</form>