$(document).ready(function(){
    
    function setCryptoRate() {
        let CryptoRate = [
            { crypto: "BTC", value: "9511.48000000" },
            { crypto: "BNB", value: "26.60360956" },
            { crypto: "BCH", value: "307.18000000" },
            { crypto: "ETH", value: "207.94000000" },
            { crypto: "ETC", value: "5.84400000" },
            { crypto: "XZC", value: "9.28" },
            { crypto: "LTC", value: "89.38000000" },
            { crypto: "NEO", value: "11.07000000" },
            { crypto: "DASH", value: "104.89000000" },
            { crypto: "EOS", value: "4.18100000" },
            { crypto: "STEEM", value: "0.23093873" },
            { crypto: "WAVES", value: "1.37250656" },
            { crypto: "XEM", value: "0.06391715" },
            { crypto: "XMR", value: "78.69000000" },
            { crypto: "XRP", value: "0.31110000" },
            { crypto: "TRX", value: "0.02181291" },
            { crypto: "USD", value: "1" },
        ];
        
        $('.ifmb-list .ifmb-list-element').each(function () {
            let thisElement = $(this),
                thisInputCrypto = thisElement.find('input.one').attr('data-currency');

            for(var crypto of CryptoRate) {
                let thisCrypto = crypto.crypto,
                    CryptoRate = crypto.value;

                if (thisCrypto == thisInputCrypto) {
                    thisElement.find('input.one').attr('data-currency-rate', CryptoRate);
                }
            }
        });
    }
    // setCryptoRate();

    // Получение данныx с первой валюты
    function onLoadSelectCrypto() {
        let listCrypto = $('.ifmb-list .ifmb-list-element').eq(0),
            editElement = $('.ifmb-list-check .ifmb-list-element');

        editElement.find('img').attr('src', listCrypto.find('img').attr('src'));
        editElement.find('small').text(listCrypto.find('small').text());
        editElement.find('input.one').val(listCrypto.find('input.one').val());
        editElement.find('input.one').attr('data-currency-type', listCrypto.find('input.one').attr('data-currency-type'));
        editElement.find('input.one').attr('data-pay-number', listCrypto.find('input.one').attr('data-pay-number'));
        editElement.find('input.one').attr('data-currency-rate', listCrypto.find('input.one').attr('data-currency-rate'));
        editElement.find('input.one').attr('data-currency', listCrypto.find('input.one').attr('data-currency'));
        
        editElement.find('input.two').attr('data-pay-number-two', listCrypto.find('input.two').attr('data-pay-number-two'));
        
            
        $('#calcWrapperInput').attr('data-rate-currency', listCrypto.find('input.one').attr('data-currency-rate'));

        $('.ifrb-cryptocurrency.active form .ifrb-form-input input.one').val(listCrypto.find('input.one').attr('data-pay-number'));
        $('.ifrb-cryptocurrency.active form .ifrb-form-input input.two').val(listCrypto.find('input.two').attr('data-pay-number-two'));
    }
    onLoadSelectCrypto();

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
        $('#calcWrapperInput').attr('aria-label', sumInputSecondLabel);
        calcSumInput.val(calcInput.val());
        $('#calcSecondWrapperInput').attr('aria-label', sumInputFirstLabel);

        if (reversActive == true) {
            reversActive = false;
            calcSumInput.val(parseFloat(calcInput.val() * calcRateCurrency.attr('data-rate-currency')).toFixed(2));
        }
        else {
            reversActive = true;
            calcSumInput.val(parseFloat(calcInput.val() / calcRateCurrency.attr('data-rate-currency')).toFixed(8));
        }
    });

    // Копирование поля
    var inputValue = $('.ifrb-form-input').find('input.one'),
        inputValueTwo = $('.ifrb-form-input').find('input.two'),
        btnCopy = $('#copyThisKey'),
        btnCopyTwo = $('#copyThisKeyTwo'),
        inputOtherValue = $('#OtherPayMethodNumber'),
        btnOtherCopy = $('#copyThisOtherKey');

    btnCopy.click(function() {
        inputValue.select();
        document.execCommand("Copy");
    });

    btnCopyTwo.click(function() {
        inputValueTwo.select();
        document.execCommand("Copy");
    });

    btnOtherCopy.click(function() {
        inputOtherValue.select();
        document.execCommand("Copy");
    });

    // Переключение и проверка формы для других систем
    var formPayOtherFirstBlock = $('.ifrbo-block-first'),
        formPayOtherFirstBtn = $('.ifrbo-next-btn-first'),
        formPayOtherSecondBlock = $('.ifrbo-block-second'),
        formPayOtherSecondBtn = $('.ifrbo-next-btn-second'),
        formPayOtherSecondPrevBtn = $('.ifrbo-prev-btn-second');
        formPayOtherThirdBlock = $('.ifrbo-block-third');

    formPayOtherFirstBtn.click(function(){
        $('.ifrb-block.active').addClass('reload');
        clearTimeout(timerReload);
        var timerReload = setTimeout(function() {
            $('.ifrb-block.active').removeClass('reload');
        }, 500);

        formPayOtherFirstBlock.removeClass('active');

        $('#SendFormOtherSystemNum').val($('#OtherPayMethodNumber').val());
        formPayOtherSecondBlock.addClass('active');
    });
    formPayOtherSecondPrevBtn.click(function() {
        $('.ifrb-block.active').addClass('reload');
        clearTimeout(timerReload);
        var timerReload = setTimeout(function() {
            $('.ifrb-block.active').removeClass('reload');
        }, 500);

        formPayOtherSecondBlock.removeClass('active');
        formPayOtherFirstBlock.addClass('active');
    });
    formPayOtherSecondBtn.click(function() {
        if ($('#PayOtherUserName').val() != '' && $('#PayOtherUserSum').val() != '' && $('#PayOtherUserPhone').val() != '') {
            $('.ifrb-block.active').addClass('reload');

            $('.ifrb-form-system').submit();

            clearTimeout(timerReload);

            var timerReload = setTimeout(function() {
                $('.ifrb-block.active').removeClass('reload');
            }, 500);
    
            // formPayOtherSecondBlock.removeClass('active');

            // formPayOtherThirdBlock.addClass('active');
        }
        else {
            if ($('#PayOtherUserName').val() == '') {
                $('#PayOtherUserName').addClass('error');
            }
            if ($('#PayOtherUserSum').val() == '') {
                $('#PayOtherUserSum').addClass('error');
            }
            if ($('#PayOtherUserPhone').val() == '') {
                $('#PayOtherUserPhone').addClass('error');
            }
        }
    });
    $('.ifrb-other-form-input input').each(function() {
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

    // Переключение и проверка формы для банк. карт
    var formPayCardsFirstBlock = $('.ifrbc-block-first'),
        formPayCardsFirstBtn = $('.ifrbc-next-btn-first'),
        formPayCardsSecondBlock = $('.ifrbc-block-second'),
        formPayCardsSecondBtn = $('.ifrbc-next-btn-second'),
        formPayCardsSecondPrevBtn = $('.ifrbc-prev-btn-second'),
        formPayCardsThirdBlock = $('.ifrbc-prev-btn-third');

    formPayCardsFirstBtn.click(function(){
        $('.ifrb-block.active').addClass('reload');
        clearTimeout(timerReload);
        var timerReload = setTimeout(function() {
            $('.ifrb-block.active').removeClass('reload');
        }, 500);

        formPayCardsFirstBlock.removeClass('active');

        $('#SendFormCardsSystemNum').val($('#CardsPayMethodNumber').val());
        formPayCardsSecondBlock.addClass('active');
    });
    formPayCardsSecondPrevBtn.click(function() {
        $('.ifrb-block.active').addClass('reload');
        clearTimeout(timerReload);
        var timerReload = setTimeout(function() {
            $('.ifrb-block.active').removeClass('reload');
        }, 500);

        formPayCardsSecondBlock.removeClass('active');
        formPayCardsFirstBlock.addClass('active');
    });
    formPayCardsSecondBtn.click(function() {
        if ($('#PayCardsUserName').val() != '' && $('#PayCardsUserSum').val() != '' && $('#PayCardsUserPhone').val() != '') {
            $('.ifrb-block.active').addClass('reload');

            $('.ifrb-form-cards-system').submit();

            clearTimeout(timerReload);
            var timerReload = setTimeout(function() {
                $('.ifrb-block.active').removeClass('reload');
            }, 500);
    
            formPayCardsSecondBlock.removeClass('active');

            formPayCardsThirdBlock.addClass('active');
        }
        else {
            if ($('#PayCardsUserName').val() == '') {
                $('#PayCardsUserName').addClass('error');
            }
            if ($('#PayCardsUserSum').val() == '') {
                $('#PayCardsUserSum').addClass('error');
            }
            if ($('#SendFormCardsSystemNum').val() == '') {
                $('#SendFormCardsSystemNum').addClass('error');
            }
            if ($('#PayCardsUserPhone').val() == '') {
                $('#PayCardsUserPhone').addClass('error');
            }
        }
    });
    $('.ifrb-cards-form-input input').each(function() {
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

    // Переключение и проверка формы для непонятной системы ??!?!?
    var formPayUnknownFirstBlock = $('.ifrbu-block-first'),
        formPayUnknownFirstBtn = $('.ifrbu-next-btn-first'),
        formPayUnknownSecondBlock = $('.ifrbu-block-second'),
        formPayUnknownSecondBtn = $('.ifrbu-next-btn-second'),
        formPayUnknownSecondPrevBtn = $('.ifrbu-prev-btn-second'),
        formPayUnknownThirdBlock = $('.ifrbu-prev-btn-third');

    formPayUnknownFirstBtn.click(function(){
        $('.ifrb-block.active').addClass('reload');
        clearTimeout(timerReload);
        var timerReload = setTimeout(function() {
            $('.ifrb-block.active').removeClass('reload');
        }, 500);

        formPayUnknownFirstBlock.removeClass('active');

        $('#SendFormUnknownSystemNum').val($('#CardsPayMethodNumber').val());
        formPayUnknownSecondBlock.addClass('active');
    });
    formPayUnknownSecondPrevBtn.click(function() {
        $('.ifrb-block.active').addClass('reload');

        clearTimeout(timerReload);
        var timerReload = setTimeout(function() {
            $('.ifrb-block.active').removeClass('reload');
        }, 500);

        formPayUnknownSecondBlock.removeClass('active');
        formPayUnknownFirstBlock.addClass('active');
    });
    formPayUnknownSecondBtn.click(function() {
        if ($('#PayUnknownUserName').val() != '' && $('#PayUnknownUserSum').val() != '' && $('#PayUnknownUserPhone').val() != '') {
            $('.ifrb-block.active').addClass('reload');

            $('.ifrb-form-unknown-system').submit();

            clearTimeout(timerReload);
            var timerReload = setTimeout(function() {
                $('.ifrb-block.active').removeClass('reload');
            }, 500);
    
            formPayCardsSecondBlock.removeClass('active');

            formPayCardsThirdBlock.addClass('active');
        }
        else {
            if ($('#PayUnknownUserName').val() == '') {
                $('#PayUnknownUserName').addClass('error');
            }
            if ($('#PayUnknownUserSum').val() == '') {
                $('#PayUnknownUserSum').addClass('error');
            }
            if ($('#SendFormUnknownSystemNum').val() == '') {
                $('#SendFormUnknownSystemNum').addClass('error');
            }
            if ($('#PayUnknownUserPhone').val() == '') {
                $('#PayUnknownUserPhone').addClass('error');
            }
        }
    });
    $('.ifrb-unknown-form-input input').each(function() {
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
    
    // Открытие списка с методом пополнения
    var selectMethodList = $('.ifmb-list-check'),
        selectBlock = $('.ifmb-select');
    
    selectMethodList.click(function(){
        if (selectBlock.hasClass('active')) {
            selectBlock.removeClass('active')
        }
        else {
            selectBlock.addClass('active');
        }
    });

    // Выбор метода оплаты
    $('.ifmb-list-block').each(function(){
        var thisBlock         = $(this),
            thisImage         = thisBlock.find('img').attr('src'),
            thisText          = thisBlock.find('small').text(),
            thisInput         = thisBlock.find('input.one').val(),
            thisInputData     = thisBlock.find('input.one').attr('data-currency'),
            thisInputDataRate = thisBlock.find('input.one').attr('data-currency-rate'),
            thisInputDataType = thisBlock.find('input.one').attr('data-currency-type'),
            thisInputDataNum  = thisBlock.find('input.one').attr('data-pay-number'),
            thisInputDataNumTwo  = thisBlock.find('input.two').attr('data-pay-number-two');

        thisBlock.click(function(){
            var editBlock = $('.ifmb-list-check .ifmb-list-element');

            editBlock.find('img').attr('src', thisImage);
            editBlock.find('small').text(thisText);
            editBlock.find('input.one').val(thisInput);
            editBlock.find('input.one').attr('data-currency', thisInputData);
            editBlock.find('input.one').attr('data-currency-rate', thisInputDataRate);
            editBlock.find('input.one').attr('data-pay-number', thisInputDataNum);
            editBlock.find('input.one').attr('data-currency-type', thisInputDataType);

            editBlock.find('input.two').attr('data-pay-number-two', thisInputDataNumTwo);
            
            $('#calcWrapperInput').attr('aria-label', thisInputData);
            $('#calcWrapperInput').attr('data-rate-currency', thisInputDataRate);
            
            calcSumInput.val(parseFloat(calcInput.val() * thisInputDataRate).toFixed(2));
            $('#calcSecondWrapperInput').attr('aria-label', 'USD');
            
            selectBlock.removeClass('active');

            if (editBlock.find('input').attr('data-currency-type') == 1 && ($('.ifrb-cards-system').hasClass('active') || $('.ifrb-other-system').hasClass('active') || $('.ifrb-unknown-system').hasClass('active'))) {
                $('.ifrb-cryptocurrency.active').addClass('reload');

                $('.ifrb-other-system').removeClass('active');
                $('.ifrb-cards-system').removeClass('active');
                $('.ifrb-unknown-system').removeClass('active');
                $('.ifrb-cryptocurrency').addClass('active');

                clearTimeout(timerReload);
                var timerReload = setTimeout(function() {
                    $('.ifrb-block.active').removeClass('reload');
                    $('#PayMethodNumber').val(thisInputDataNum);
                    $('#PayMethodNumberTwo').val(thisInputDataNumTwo);
                    $('#resultImage img').attr('src', thisImage);
                }, 500);
            }
            else if (editBlock.find('input').attr('data-currency-type') == 2 && ($('.ifrb-cryptocurrency').hasClass('active') || $('.ifrb-cards-system').hasClass('active') || $('.ifrb-unknown-system').hasClass('active'))) {
                $('.ifrb-other-system.active').addClass('reload');

                formPayOtherFirstBlock.addClass('active');
                formPayOtherSecondBlock.removeClass('active');
                formPayOtherThirdBlock.removeClass('active');

                $('.ifrb-cryptocurrency').removeClass('active');
                $('.ifrb-cards-system').removeClass('active');
                $('.ifrb-unknown-system').removeClass('active');
                $('.ifrb-other-system').addClass('active');
                    
                clearTimeout(timerReload);
                var timerReload = setTimeout(function() {
                    $('.ifrb-block.active').removeClass('reload');
                    $('#OtherPayMethodNumber').val(thisInputDataNum);
                }, 500);
            }
            else if (editBlock.find('input').attr('data-currency-type') == 3 && ($('.ifrb-cryptocurrency').hasClass('active') || $('.ifrb-other-system').hasClass('active') || $('.ifrb-unknown-system').hasClass('active'))) {
                $('.ifrb-cards-system.active').addClass('reload');

                formPayCardsFirstBlock.addClass('active');
                formPayCardsSecondBlock.removeClass('active');
                formPayCardsThirdBlock.removeClass('active');

                $('.ifrb-cryptocurrency').removeClass('active');
                $('.ifrb-other-system').removeClass('active');
                $('.ifrb-unknown-system').removeClass('active');
                $('.ifrb-cards-system').addClass('active');
                    
                clearTimeout(timerReload);
                var timerReload = setTimeout(function() {
                    $('.ifrb-block.active').removeClass('reload');
                }, 500);
            }
            else if (editBlock.find('input').attr('data-currency-type') == 4 && ($('.ifrb-cryptocurrency').hasClass('active') || $('.ifrb-other-system').hasClass('active') || $('.ifrb-cards-system').hasClass('active'))) {
                $('.ifrb-unknown-system.active').addClass('reload');

                formPayUnknownFirstBlock.addClass('active');
                formPayUnknownSecondBlock.removeClass('active');
                formPayUnknownThirdBlock.removeClass('active');

                $('.ifrb-cryptocurrency').removeClass('active');
                $('.ifrb-other-system').removeClass('active');
                $('.ifrb-cards-system').removeClass('active');
                $('.ifrb-unknown-system').addClass('active');
                    
                clearTimeout(timerReload);
                var timerReload = setTimeout(function() {
                    $('.ifrb-block.active').removeClass('reload');
                }, 500);
            }
            
            if (editBlock.find('input').attr('data-currency-type') == 1) {
                clearTimeout(timerReload);
                var timerReload = setTimeout(function() {
                    $('.ifrb-block.active').removeClass('reload');
                    $('#PayMethodNumber').val(thisInputDataNum);
                    $('#PayMethodNumberTwo').val(thisInputDataNumTwo);
                }, 500);
            }
            else if (editBlock.find('input').attr('data-currency-type') == 2) {
                clearTimeout(timerReload);
                var timerReload = setTimeout(function() {
                    $('.ifrb-block.active').removeClass('reload');
                    $('#OtherPayMethodNumber').val(thisInputDataNum);
                    
                    formPayOtherFirstBlock.addClass('active');
                    formPayOtherSecondBlock.removeClass('active');
                    formPayOtherThirdBlock.removeClass('active');
                }, 500);
            }
            else if (editBlock.find('input').attr('data-currency-type') == 3) {
                clearTimeout(timerReload);
                var timerReload = setTimeout(function() {
                    $('.ifrb-block.active').removeClass('reload');
                    
                    formPayCardsFirstBlock.addClass('active');
                    formPayCardsSecondBlock.removeClass('active');
                    formPayCardsThirdBlock.removeClass('active');
                }, 500);
            }
            else if (editBlock.find('input').attr('data-currency-type') == 4) {
                clearTimeout(timerReload);
                var timerReload = setTimeout(function() {
                    $('.ifrb-block.active').removeClass('reload');
                    
                    formPayUnknownFirstBlock.addClass('active');
                    formPayUnknownSecondBlock.removeClass('active');
                    formPayUnknownThirdBlock.removeClass('active');
                }, 500);
            }

            $('.ifrb-block.active').addClass('reload');
            
            
            reversActive = false;
        });
    });
});

function previewFile(n) {
	var fileBlock   = document.querySelectorAll('.file-block')[n],
		file 		= fileBlock.querySelector('input[type=file]').files[0],
		fileImg 	= fileBlock.querySelector('label').querySelector('img'),
		reader 		= new FileReader();
		
	file ? reader.readAsDataURL(file) : fileImg.src  = "";
	
	reader.onloadend = function () {
		fileImg.src  = reader.result;
		fileBlock.querySelector('label').querySelector('small').style.fontSize = 0 + 'px';
		fileBlock.querySelector('small.remove-file').classList.add('remove-file--view');
	}
}

function removeLoadFile(n) {
	var fileBlock   = document.querySelectorAll('.file-block')[n],
		fileLoadedImg 	= fileBlock.querySelector('img');

		fileLoadedImg.src = "";
		fileBlock.querySelector('label').querySelector('small').style.fontSize = 42 + 'px';
		fileBlock.querySelector('small.remove-file').classList.remove('remove-file--view');
}