;$(function () {
    /**
     * Обработка нажатий кнопок на странице Баланс->Пополнить баланс
     * Старое название: changeDescPayments()
     */

    function balansFormOnChange(dataPaymentSystem) {
        // Проверка: является ли выбранный элемент картой
        let isCard = dataPaymentSystem === 'card' ? true : false;
        
        // При пополнении, модальное окно: Заголовок
        let instructionTitle =  document.querySelector('#modalDescPayments .modal-title span');

        // При пополнении, модальное окно: Содержимое
        let instructionContent = document.querySelector('#modalDescPayments #modal-content');

        // Кнопка (в ввиде ссылки) показать инструкцию
        let btnShowInstruction = document.querySelector('#modalDescPaymentsButton span');

        // Кнопка пополнить
        let btnPayment = document.querySelector('[data-buttonPay]');

        // Поле ввода для суммы пополнения
        let amountPayment = $('#input-postal-code');
        
        // Объект с подготовленными заголовками
        let titles = {
            payeer: 'Payeer',
            bitcoin: 'Bitcoin',
            perfect_money: 'Perfect Money',
            prizm: 'Prizm',
            ethereum: 'Ethereum',
            tether: 'Tether',
            card: trans('base.dash.payments_methods.card-title')
        }

        if(!isCard) {
            amountPayment.attr('disabled', false).val('');
            btnPayment.disabled = false;
        }
        else {
            amountPayment.attr('disabled', true).val('');
            btnPayment.disabled = true;
        }

        instructionContent.innerHTML = trans(`base.dash.payments_methods.${dataPaymentSystem}`);
        instructionTitle.textContent = btnShowInstruction.textContent = titles[dataPaymentSystem];
    }

    balansFormOnChange($('.balans-form__item input:checked').data('paymentSystem'))

    $('.balans-form').on('change', function(e) {
        // Название выбранной платежной системы
        let dataPaymentSystem = e.target.getAttribute('data-payment-system');
        
        balansFormOnChange(dataPaymentSystem);
    });

    /**
     * Для поля "сумма пополнения" на странице Баланс->Пополнить баланс
     * Старое название: changePlaceholderOnPay(currency)
     */
    $('.form-payment').on('click', function () {
        let dataAmountType = $(this).find('input').attr('data-amount-type');
        $('#input-postal-code').prop('placeholder', '0 ' + dataAmountType);
        if (dataAmountType == 'USDT') $('#modalDescPaymentsButton').attr('data-target', '#modalDescPaymentsUSDT');
        else $('#modalDescPaymentsButton').attr('data-target', '#modalDescPayments');
    });

    $('#input-postal-code').on('input', function () {
        if (this.value < 0) {
            this.value = 0;
        }
    });
});
