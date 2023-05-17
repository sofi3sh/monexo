;$(function () {
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Select your input element.
    let number = document.getElementById('input-offer_amount_from');

    // Listen for input event on numInput.
    number.onkeydown = function(e) {
        if (e.keyCode == 109 || e.keyCode == 189) {
            return false;
        }
    };


    $('#button-exchange').on('click', function () {
        const commissionRate = 0.96;
        const commissionAmount = 0.99;
        let currencyFrom = $('[name="offer_balance_from"]').val();
        let currencyTo = $('[name="offer_balance_to"]').val();
        let amountFrom = $('[name="offer_amount_from"]').val();

        if ( ! amountFrom || amountFrom <= 0 ) {
            $('#button-exchange-confirm').attr('disabled', true);
            $('#error-message').text('Не указана сумма списываемая с баланса');
            return;
        } else {
            $('#button-exchange-confirm').attr('disabled', false);
        }

        $.ajax({
            url: '/home/balance/rate-front',
            method: 'POST',
            data: {
                _token: csrfToken,
                currency_from: currencyFrom,
                currency_to: currencyTo,
            },
            dataType: 'json',
            success: function(response) {
                if (response.code === 'success') {
                    let rateOriginal = response.rate;
                    let rateMinusCommission = rateOriginal * commissionRate;

                    let amountMinusCommission = amountFrom * commissionAmount;
                    let amountTo = amountMinusCommission * rateMinusCommission;

                    $('#rate-original').text( rateOriginal );
                    $('#amount-commission').text( amountMinusCommission );

                    $('[name="rate"]').val( rateMinusCommission );
                    $('[name="amount_to"]').val( amountTo );

                    console.log(rateMinusCommission, amountTo);
                } else {
                    $('#error-message').text( response.message );
                }
            },
            error: function(jqXHR, exception) {
                $('#error-message').text(jqXHR.responseText);
            }
        });

        $('[name="currency_from"]').val( currencyFrom );
        $('[name="currency_to"]').val( currencyTo );
        $('[name="amount_from"]').val( amountFrom );
    });
});
