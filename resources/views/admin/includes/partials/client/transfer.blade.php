{{-- Переводы между аккаунтами --}}

<form action="{{ route('admin.transfers-between-accounts') }}" method="POST">
    @csrf
    {{-- Скрытые поля --}}
    <input type="text" class="invisible" name="from_user_id" value="{{ $user->id }}">

    <div class="row">
        <div class="col-lg-3">
            <label>Сумма перевода (с текущего аккаунта), $</label>
            <input type="number" name="amount_usd" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <label>email на который перевести</label>
            <input type="text" name="to_email" class="form-control">
        </div>
    </div>

    <div class="row" style="padding-top: 1em">
        <div class="col-lg-12">
            <button type="submit" class="login-page__submit login-block__submit button">
                Перевести
            </button>
        </div>
    </div>
</form>