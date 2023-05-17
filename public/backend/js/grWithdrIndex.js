$(document).ready(function(){
    
    // Получение данныx с первой валюты
    function onLoadSelectSystem() {
        let listCrypto = $('.wfmb-list .wfmb-list-element').eq(0),
            editElement = $('.wfmb-list-check .wfmb-list-element');

        editElement.find('img').attr('src', listCrypto.find('img').attr('src'));
        editElement.find('small').text(listCrypto.find('small').text());
        editElement.find('input.one').val(listCrypto.find('input.one').val());
        editElement.find('input.one').attr('data-currency-type', listCrypto.find('input.one').attr('data-currency-type'));
        editElement.find('input.one').attr('data-pay-number', listCrypto.find('input.one').attr('data-pay-number'));
        editElement.find('input.one').attr('data-currency-rate', listCrypto.find('input.one').attr('data-currency-rate'));
        editElement.find('input.one').attr('data-currency', listCrypto.find('input.one').attr('data-currency'));
        editElement.find('input.one').attr('data-currency', listCrypto.find('input.one').attr('data-currency'));
        
        editElement.find('input.two.currency_id').val(listCrypto.find('input.two.currency_id').val());
        $("input#WithdrawalCurrencyID").val(listCrypto.find('input.two.currency_id').val());

        $('.wfrb-other-system.active form .wfrb-form-wrapper-input input#WithdrawalSystem').val(listCrypto.find('input.one').val());
        $('.wfrb-other-system.active form .wfrb-form-wrapper-input img').attr("src", listCrypto.find('img').attr('src'));
        
        $('#calcWrapperInput').attr('data-rate-currency', listCrypto.find('input.one').attr('data-currency-rate'));

        if(listCrypto.find('input.one').attr('data-currency-type') == "1") {
            $("input#to_payment_systems").attr("checked", false);
        }
        else if(listCrypto.find('input.one').attr('data-currency-type') == "2") {
            $("input#to_payment_systems").attr("checked", true);
        }
    }
    onLoadSelectSystem();
    
    // Подсчет курса
    var calcInput = $('#calcInput'),
        calcRateCurrency = $('#calcWrapperInput'),
        calcSumInput = $('#calcSumInput');

    function calcSumRate() {
        if (reversActive == true) {
            calcSumInput.val(parseFloat(calcInput.val() / calcRateCurrency.attr('data-rate-currency')).toFixed(8));
        }
        else {
            calcSumInput.val(parseFloat(calcInput.val() * calcRateCurrency.attr('data-rate-currency')).toFixed(2));
        }
    }

    calcInput.keyup(function() {
        calcSumRate();
    });

    // Реверс сум
    var reversActive = false;

    $('#calcReverseSumInput').click(function() {
        var sumInputFirstLabel = $('#calcWrapperInput').attr('aria-label'),
            sumInputSecondLabel = $('#calcSecondWrapperInput').attr('aria-label');

        calcInput.val(calcSumInput.val());
        calcInput.attr('aria-label', sumInputSecondLabel);
        calcSumInput.val(calcInput.val());
        calcSumInput.attr('aria-label', sumInputFirstLabel);

        if (reversActive == true) {
            reversActive = false;
            calcSumInput.val(parseFloat(calcInput.val() * calcRateCurrency.attr('data-rate-currency')).toFixed(2));
        }
        else {
            reversActive = true;
            calcSumInput.val(parseFloat(calcInput.val() / calcRateCurrency.attr('data-rate-currency')).toFixed(8));
        }
    });

    // Переключение формы вывода
    var firstFormBlock = $('.wfrbo-block-first'),
        firstFormBtnNext = firstFormBlock.find('.wfrbo-next-btn'),
        secondFormBlock = $('.wfrbo-block-second'),
        secondFormBtnSend = secondFormBlock.find('.wfrbo-send-btn'),
        secondFormBtnPrev = secondFormBlock.find('.wfrbo-prev-btn');

    firstFormBtnNext.on("click", () => {
        if (firstFormBlock.hasClass("active")) {
            $('.wfrb-block.active').addClass('reload');

            firstFormBlock.removeClass("active");
            secondFormBlock.addClass("active");

            setTimeout(() => {
                $('.wfrb-block.reload').removeClass('reload');
            }, 500);
        }
    });
    secondFormBtnPrev.on("click", () => {
        if (secondFormBlock.hasClass("active")) {
            $('.wfrb-block.active').addClass('reload');

            secondFormBlock.removeClass("active");
            firstFormBlock.addClass("active");

            setTimeout(() => {
                $('.wfrb-block.reload').removeClass('reload');
            }, 500);
        }
    });
    secondFormBtnSend.on("click", () => {
        let withdrawalSum = secondFormBlock.find("#WithdrawalSum"),
            withdrawalReq = secondFormBlock.find("#WithdrawalRequisites"),
            withdrawalAddReq = secondFormBlock.find("#WithdrawalAddRequisites");

        if (withdrawalSum.val() != "" && withdrawalReq.val() != "" && withdrawalAddReq.val() != "") {
            $('.wfrb-block.active').addClass('reload');

            $('.wfrb-form-system').submit();
        }
    });

    // Проверка формы для других систем
    $('.wfrb-other-form-input input').each(function() {
        var thisElemForm = $(this);

		thisElemForm.focusin(function() {
			thisElemForm.removeClass('error');
		});
		thisElemForm.focusout(function() {
            if (thisElemForm.val() == '') {
                thisElemForm.removeClass('error');
                thisElemForm.addClass('error');
            }
            else if (thisElemForm.val() != '') {
                thisElemForm.removeClass('error');
                thisElemForm.addClass('good');
            }
		});
    });
    
    // Открытие списка с методом вывода
    var selectMethodList = $('.wfmb-list-check'),
        selectBlock = $('.wfmb-select');
    
    selectMethodList.click(function(){
        if (selectBlock.hasClass('active')) {
            selectBlock.removeClass('active')
        }
        else {
            selectBlock.addClass('active');
        }
    });

    // Выбор метода оплаты
    $('.wfmb-list .wfmb-list-block').each(function(){
        var thisBlock         = $(this),
            thisImage         = thisBlock.find('img').attr('src'),
            thisText          = thisBlock.find('small').text(),
            thisInput         = thisBlock.find('input.one').val(),
            thisInputData     = thisBlock.find('input.one').attr('data-currency'),
            thisInputDataRate = thisBlock.find('input.one').attr('data-currency-rate'),
            thisInputDataType = thisBlock.find('input.one').attr('data-currency-type'),
            thisInputDataNum  = thisBlock.find('input.one').attr('data-pay-number'),
            thisInputCurrID   = thisBlock.find('input.two.currency_id').val();

        thisBlock.click(function(){
            var editBlock = $('.wfmb-list-check .wfmb-list-element');
            var resultSystem = $('.WithdrawalSelectSystem');
            
            let withdrawalSum = $('.wfrbo-block-second').find("#WithdrawalSum"),
                withdrawalReq = $('.wfrbo-block-second').find("#WithdrawalRequisites"),
                withdrawalAddReq = $('.wfrbo-block-second').find("#WithdrawalAddRequisites");

            editBlock.find('img').attr('src', thisImage);
            editBlock.find('small').text(thisText);
            editBlock.find('input.one').val(thisInput);
            editBlock.find('input.one').attr('data-currency', thisInputData);
            editBlock.find('input.one').attr('data-currency-rate', thisInputDataRate);
            editBlock.find('input.one').attr('data-pay-number', thisInputDataNum);
            editBlock.find('input.one').attr('data-currency-type', thisInputDataType);
        
            editBlock.find('input.two.currency_id').val(thisInputCurrID);
            $("input#WithdrawalCurrencyID").val(thisInputCurrID);

            if(thisInputDataType == "1") {
                $("input#to_payment_systems").attr("checked", false);
            }
            else if(thisInputDataType == "2") {
                $("input#to_payment_systems").attr("checked", true);
            }

            resultSystem.find("input").val(thisText);
            resultSystem.find("img").attr("src", thisImage);
            
            $('#calcWrapperInput').attr('aria-label', thisInputData);
            $('#calcWrapperInput').attr('data-rate-currency', thisInputDataRate);
            
            calcSumInput.val(parseFloat(calcInput.val() * thisInputDataRate).toFixed(2));
            $('#calcSecondWrapperInput').attr('aria-label', 'USD');
            
            selectBlock.removeClass('active');

            $('.wfrb-block.active').addClass('reload');

            secondFormBlock.removeClass("active");
            firstFormBlock.addClass("active");

            setTimeout(() => {
                $('.wfrb-block.reload').removeClass('reload');
            }, 500);

            withdrawalSum.val("");
            withdrawalSum.removeClass("error");
            withdrawalSum.removeClass("good");
            withdrawalReq.val("");
            withdrawalReq.removeClass("error");
            withdrawalReq.removeClass("good");
            withdrawalAddReq.val("");
            withdrawalAddReq.removeClass("error");
            withdrawalAddReq.removeClass("good");
            
            reversActive = false;
        });
    });
});