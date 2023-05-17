{{-- Other system form --}}
<form action="{{ route('home.invest.request-other-payment-system') }}"
      enctype="multipart/form-data"
      method="POST" 
      class="base_form invest_form other_system">
    @csrf

    <div class="block">
        <label for="user_sum">Сумма пополнения</label>
        <input type="text" id="user_sum" name="user_sum">
        <small class="input-ending">USD</small>
    </div>
    <div class="block">
        <label for="user_card">Номер счета</label>
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
        <p class="info">Что бы отправить заявку на ввод с другой платежной системы, нажмите кнопку "Отправить"</p>
        <button type="submit">Отправить</button>
    </div>
</form>