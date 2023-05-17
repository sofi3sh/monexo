$(function() {
    const $form = $('#form-withdrawal');
    
    const rates = {
        'btc': $('#rate-bitcoin').attr('data-bitcoin'),
        'pzm': $('#rate-prizm').attr('data-prizm'),
        'eth': $('#rate-ethereum').attr('data-ethereum'),
        'usdt': $('#rate-tether').attr('data-tether')
    }
    
    const payments = {
        'btc': {
            'min': (25 / rates['btc']).toFixed(8),
            'type': 'crypto',
        },
        'pzm': {
            'min': (25 / rates['pzm']).toFixed(8),
            'type': 'crypto',
        },
        'eth': {
            'min': (25 / rates['eth']).toFixed(8),
            'type': 'crypto',
        },
        'usdt': {
            'min': 25,
            'type': 'crypto',
            'typeName': 'usdt',
        },
        'perfect': {
            'min': 5,
            'isCrypto': false,
        },
        'credit card': {
            'min': 40,
            'max': withdrawalLimits['card'],
            'type': 'card',
        },
    }

    const placeholders = {
        'card': trans('base.dash.balance.withdraw_wallet_card'),
        'default': trans('base.dash.balance.withdraw_wallet')
    }

    const $inputAmount = $form.find('[name="amount"]');
    const $inputAddress = $form.find('[name="address"]');
    const $inputAmountWithCommission = $form.find('#result-conclusion');
    
    setUserInterface();

    $('.withdrawal-item').on('click', function () {
        const paymentName = $(this).data('payment-system');
        const currencyCode = $(this).data('currency-code');
        const payment = payments[paymentName];
        
        if (paymentName == 'usdt') $('input[name="amount"]').attr('data-paysystem', 'usdt');
        else $('input[name="amount"]').attr('data-paysystem', '');

        reviseStep(currencyCode, $inputAmount);
        showPayment(payment);
        setPaymentAddInfo(payment, currencyCode);

        $inputAddress.val('');
        $inputAmountWithCommission.val('');

        $('.withdrawal-input-number')
            .val('')
            .attr('data-max', payment.max)
            .attr('data-min', payment.min);

    });

    $('.withdrawal-input-number')
        .on('input', function () {

            const amount = $('input[name="amount"]').val();
            const commision = withdrawalCommission / 100;
            if ($('input[name="amount"]').data('paysystem') != 'usdt') $('#result-conclusion').val(amount * ( 1 - commision));
            else  $('#result-conclusion').val( amount - 1 < 0 ? 0 : amount - 1 );
            
        })
        .on('change', function() {
            
            $(this).val(
                Math.max(Math.min(+$(this).val(), +$(this).data('max')), +$(this).data('min'))
            );

            const amount = $('input[name="amount"]').val();
            const commision = withdrawalCommission / 100;
            if ($('input[name="amount"]').data('paysystem') != 'usdt') $('#result-conclusion').val(amount * ( 1 - commision));
            else  $('#result-conclusion').val( amount - 1 < 0 ? 0 : amount - 1 );
    });



    function setPaymentAddInfo(payment, currencyCode) {
        const path = 'base.dash.balance';
        let max = '';

        if(payment.max) {
            max = trans(`${path}.max`, {'amount': payment.max, 'currency': currencyCode}) + '/ ';
        }

        $('h6.commission').text(
            trans(`${path}.minimal`, {amount: payment.min, currency: currencyCode}) +
            ' / ' + 
            max +
            trans('base.dash.balance.withdraw_commission') + ' ' + (payment.typeName == 'usdt' ? '2 USDT' : withdrawalCommission + '%')
        );
    }

    console.log(document.querySelectorAll('.input-conclusion'));

    function showPayment(payment) {
        if (payment.typeName == 'usdt') $('#withdrawalModalButton').attr('data-target', '#withdrawalModalUSDT');
        else $('#withdrawalModalButton').attr('data-target', '#withdrawalModal');

        const $purse = $('.withdrawal-purse');
        if(payment.type === 'crypto') {
            $purse.attr('placeholder', placeholders['default'])
            if (payment.typeName != 'usdt') showCryptoFields();
            else hideCryptoDetails();
            hideCardFields();
        } else if(payment.type === 'card') {
            $purse.attr('placeholder', placeholders['card'])
            hideCryptoDetails();
            showCardFields();
        }
        else {
            $purse.attr('placeholder', placeholders['default'])
            hideCryptoDetails();
            hideCardFields();
        }
    }

    function showCryptoFields() {
        $('.crypto_details').fadeIn()
    };
    
    function hideCryptoDetails() {
        $('.crypto_details').fadeOut();
    }

    function showCardFields() {
        $('.card_details').fadeIn();
        $('.card_details input').attr('required', true).prop('disabled', false);
        $('.card_details .js-optional').removeAttr('required');
    }

    function hideCardFields() {
        $('.card_details').fadeOut();
        $('.card_details input').removeAttr('required').prop('disabled', true);
    }

    function reviseStep(currencyCode, $inputAmount) {
        if (currencyCode === 'USD') {
            $inputAmount.attr('step', '0.01');
        } else {
            $inputAmount.attr('step', '0.000001');
        }
    }

    function setUserInterface() {
        
        $(".js-only-cyrylic").on('input',function() {
            $value = $(this).val().replace(/[^а-яё]/i, "");
            $(this).val($value);
        });
    
        $('#pay-14').on('click', function () {
            $("input[name=address]").inputmask({regex: "U[0-9]*"});
        });
    
        $('#pay-12, #pay-13, #pay-15, #pay-16').on('click', function () {
            $("input[name=address]").inputmask('remove');
        });
    }
});
