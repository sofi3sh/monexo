{{-- Eps form --}}
<form action="{{ route('home.invest.payed-payment-system') }}" 
      enctype="multipart/form-data"
      method="POST" 
      class="base_form invest_form eps_system">
    @csrf

    <div class="block">
        <label for="our_address">Адрес для перевода</label>
        <input type="text" class="address" id="our_address" name="our_address" value="" readonly>
        <button type="button" class="copy" data-copyed="our_address">Copy</button>
    </div>
    <div class="block">
        <label for="user_sum">Сумма пополнения</label>
        <input type="text" id="user_sum" name="user_sum">
        <small class="input-ending">USD</small>
    </div>
    <div class="block">
        <label for="user_card">Номер Вашего счета (от куда был выполнен перевод)</label>
        <input type="text" id="user_card" name="user_card">
    </div>
    <div class="block">
        <label for="user_name">Имя, Фамилия</label>
        <input type="text" id="user_name" name="user_name">
    </div>
    <div class="block">
        <label for="user_phone">Ваш мобильный номер</label>
        <input type="text" id="user_phone" name="user_phone">
    </div>
    
    <div class="control">
        <p class="info">Что бы отправить заявку на ввод с карты, нажмите кнопку "Отправить"</p>
        <button type="submit">Отправить</button>
    </div>
</form>