{{-- Cryptocurrency form --}}
<form action="#" method="GET" class="base_form invest_form crypto_currency_system">
    <div class="block">
        <label for="user_address">Адрес кошелька</label>
        <input type="text" id="user_address" class="address" name="user_address" value="" readonly>
        <button type="button" class="copy" data-copyed="user_address">Copy</button>
    </div>
    <div class="block">
        <label for="user_add_address">Доп. реквизиты (MEMO, comment)</label>
        <input type="text" id="user_add_address" class="add_address" name="user_add_address" value="" readonly>
        <button type="button" class="copy" data-copyed="user_add_address">Copy</button>
    </div>
    
    <div class="control">
        <p class="info" style="max-width: 100%;">Что бы пополнить счет с криптовалюты, используйте сгенерированный адрес кошелька и доп. реквизиты (если они имеются)</p>
    </div>
</form>