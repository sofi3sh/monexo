$(document).ready(function(){

	if($('.input-select--select2').length > 0)
		$('.input-select--select2').select2({
			minimumResultsForSearch: 10,
		});


	function showTooltip(elem, msg) {
		var classes = elem.getAttribute('class');
		classes += " hint--bottom";
		elem.setAttribute('class', classes);
		elem.setAttribute('aria-label', msg);
	}
	function clearTooltip(e, msg) {
		var classes = e.getAttribute('class');
		var classes = classes.replace('hint--bottom', '')
		e.setAttribute('class', classes);
		e.setAttribute('aria-label', msg);
	}

	var clipboard = new ClipboardJS('.js-copy');
	clipboard.on('success', function(e) {
		var elem = e.trigger;

		if(!$(elem).hasClass('button')){
			var old = $(elem).html();
			$(elem).html('<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"><path d="M0 11.522l1.578-1.626 7.734 4.619 13.335-12.526 1.353 1.354-14 18.646z"/></svg>');
			setTimeout(function(){
				$(elem).html(old);
			}, 1000)
		}

		var copied = elem.getAttribute('data-copied');
		var copy = elem.getAttribute('aria-label');

		showTooltip(elem, copied);
		setTimeout(function(){
			clearTooltip(elem, copy);	
		}, 1500)
		
		e.clearSelection();
	});

	

	$('.nav_toggle').click(function(){
		$('.menu').toggleClass('menu--hidden');
		$('.menu').toggleClass('menu--visible');
		$('.content').toggleClass('blur');
		$('footer').toggleClass('blur');
		$('.nav_toggle').toggleClass('open');
	})
	$('.top-header__user--mobile').click(function(){
		$('.top-header__user-dropdown--mobile').toggleClass('is-open');
	})
	
	// $('body').click(function(){
	// 	$('.top-header__user-dropdown--mobile').removeClass('is-open');
	// })

	var tabs = $('.tabs_wrap');
	$('.tabs-content > div', tabs).each(function(i){
		if ( i != 0 ) $(this).hide(0);
	});
	tabs.on('click', '.tabs a', function(e){
		/* Предотвращаем стандартную обработку клика по ссылке */
		e.preventDefault();

		/* Узнаем значения ID блока, который нужно отобразить */
		var tabId = $(this).attr('href');

		/* Удаляем все классы у якорей и ставим active текущей вкладке */
		$('.tabs a',tabs).removeClass();
		$(this).addClass('active');

		/* Прячем содержимое всех вкладок и отображаем содержимое нажатой */
		$('.tabs-content > div', tabs).hide(0);
		$(tabId).show();
	});
});

$('a.smoothscroll').on('click', function(event) {

	event.preventDefault();
	var sc = $(this).attr("href"),
	dn = $(sc).offset().top;
	$('html, body').animate({scrollTop: dn}, 1000);
});


(function(){
	var d = document,
	accordionToggles = d.querySelectorAll('.js-accordionTrigger'),
	setAria,
	setAccordionAria,
	switchAccordion,
	touchSupported = ('ontouchstart' in window),
	pointerSupported = ('pointerdown' in window);

	skipClickDelay = function(e){
		e.preventDefault();
		e.target.click();
	}

	setAriaAttr = function(el, ariaType, newProperty){
		el.setAttribute(ariaType, newProperty);
	};
	setAccordionAria = function(el1, el2, expanded){
		switch(expanded) {
			case "true":
			setAriaAttr(el1, 'aria-expanded', 'true');
			setAriaAttr(el2, 'aria-hidden', 'false');
			break;
			case "false":
			setAriaAttr(el1, 'aria-expanded', 'false');
			setAriaAttr(el2, 'aria-hidden', 'true');
			break;
			default:
			break;
		}
	};
	switchAccordion = function(e) {
		console.log("triggered");
		e.preventDefault();
		var thisAnswer = e.target.parentNode.nextElementSibling;
		var thisQuestion = e.target;
		if(thisAnswer.classList.contains('is-collapsed')) {
			setAccordionAria(thisQuestion, thisAnswer, 'true');
		} else {
			setAccordionAria(thisQuestion, thisAnswer, 'false');
		}
		thisQuestion.classList.toggle('is-collapsed');
		thisQuestion.classList.toggle('is-expanded');
		thisAnswer.classList.toggle('is-collapsed');
		thisAnswer.classList.toggle('is-expanded');

		thisAnswer.classList.toggle('animateIn');
	};
	for (var i=0,len=accordionToggles.length; i<len; i++) {
		if(touchSupported) {
			accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
		}
		if(pointerSupported){
			accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
		}
		accordionToggles[i].addEventListener('click', switchAccordion, false);
	}
})();

$(document).ready(function() {
	var puMenuHead = $('.menu-head--user'),
		puMenuRefs = $('.menu-head--refs'),
		puBlockUser = $('.menu-block--user'),
		puBlockRefs = $('.menu-block--refs');

	puMenuHead.on('click', function() {
		puBlockRefs.removeClass('menu-block--active');
		puMenuRefs.removeClass('menu-head-item--active');
		puBlockUser.addClass('menu-block--active');
		puMenuHead.addClass('menu-head-item--active');
	});
	puMenuRefs.on('click', function() {
		puBlockUser.removeClass('menu-block--active');
		puMenuHead.removeClass('menu-head-item--active');
		puBlockRefs.addClass('menu-block--active');
		puMenuRefs.addClass('menu-head-item--active');
	});


	// Раскрытие всеx рейтов криптовалют
	var ratesBlock = $('.rates'),
		ratesControlView = $('.rcb--view-all'),
		ratesControlHide = $('.rcb--hide-all');

	ratesControlView.click(function() {
		ratesBlock.addClass('rates-all');
		ratesControlView.removeClass('rcb--visible');
		ratesControlHide.addClass('rcb--visible');
	});
	ratesControlHide.click(function() {
		ratesBlock.removeClass('rates-all');
		ratesControlHide.removeClass('rcb--visible');
		ratesControlView.addClass('rcb--visible');
	});

	// Раскрытие всеx криптокошельков
	var investCryptoBlock = $('.invest-table'),
		investCryptoControlView = $('.itb--view-all'),
		investCryptoControlHide = $('.itb--hide-all');

	investCryptoControlView.click(function() {
		investCryptoBlock.addClass('invest-table--visible');
		investCryptoControlView.removeClass('itb--visible');
		investCryptoControlHide.addClass('itb--visible');
	});
	investCryptoControlHide.click(function() {
		investCryptoBlock.removeClass('invest-table--visible');
		investCryptoControlHide.removeClass('itb--visible');
		investCryptoControlView.addClass('itb--visible');
	});

	$(window).scroll(function() {
		var scrollTopWindow = $(this).scrollTop();
		if (scrollTopWindow > 0) {
			$('.menu__user-block').addClass('menu__user-block--hide');
		}
		else {
			$('.menu__user-block').removeClass('menu__user-block--hide');
		}
	});


	// Investment form block
	var payTapeWindow = $('.pt--window-pay'),
		pTW_close = $('.wpb-form_close'),
	    pTW_logo = $('.wpb-form--logo'),
	    pTW_input = $('.wpb-form--input-paynum'),
	    pTW_name = $('.wpb-form--name');

	$('.pt-block-act').each(function() {
		var thisBlock = $(this),
			tBlockLogo = thisBlock.find('.pt-block--logo').html(),
			tBlockTitle = thisBlock.find('.pt-block--title h4').text(),
			tBlockData = thisBlock.find('.pt-block--title').data('payment');

		thisBlock.click(function() {

			/* Получаем номер счета и меняем value у input */
			pTW_input.val(tBlockData);
			/* Получаем name системы и передаем её в скрытое поле */
			pTW_name.val(tBlockTitle);
			console.log(tBlockTitle);
			/* Получаем картинку системы и передаем её в label */
			pTW_logo.html(tBlockLogo);

			payTapeWindow.addClass('pt--window-pay--open');
		});
	});
	pTW_close.click(function() {
		payTapeWindow.removeClass('pt--window-pay--open');
	});

	var payTapeOtherWindow = $('.pt--window-pay-other'),
		pTOW_block = $('.pt-block-other'),
		pTOW_close = $('.wpob-form_close');

	pTOW_block.click(function() {
		payTapeOtherWindow.addClass('pt--window-pay-other--open');
	});
	pTOW_close.click(function() {
		payTapeOtherWindow.removeClass('pt--window-pay-other--open');
	});

	// Adversting
	var advFromWindow = $('.reward-form-wrapper'),
		aFW_block = $('.rbc--btn'),
		aFW_close = $('.rfw-form_close');

	aFW_block.click(function() {
		advFromWindow.addClass('reward-form-wrapper--open');
	});
	aFW_close.click(function() {
		advFromWindow.removeClass('reward-form-wrapper--open');
	});

	// User question form

	var userQuestionWindow = $('.uq-form-window'),
		uQW_block = $('.uq-btn-js'),
		uQW_close = $('.uqf-form_close');

	uQW_block.click(function() {
		userQuestionWindow.addClass('uq-form-window--open');
	});
	uQW_close.click(function() {
		userQuestionWindow.removeClass('uq-form-window--open');
	});

	// Вывод "чекбокс" плат. системы
	var paySystemChekBox = $('#to_payment_systems'),
		payCryptoBlock = $('.input-wrap--crypto_currency'),
		paySystemBlock = $('.input-wrap--payment_system');

	paySystemChekBox.on('change', function() {
		if (paySystemChekBox.prop('checked')) {
			payCryptoBlock.removeClass('iwrp_system--active');
			paySystemBlock.addClass('iwrp_system--active');
		}
		else {
			paySystemBlock.removeClass('iwrp_system--active');
			payCryptoBlock.addClass('iwrp_system--active');
		}
	});

	
    // Hide & Unhide Top trader
    var tradeContentBlock = $('.ttw--trades'),
        tradeContentWrapper = $('.ttw--trades-content'),
        tradeBlock = $('.top-trade'),
        tradeControl = $('.trade-view-btn');

    tradeControl.click(function () {
        var tBHeight = tradeContentWrapper.children(0).outerHeight(true),
			tCWHeight = tradeContentWrapper.outerHeight(true);

        if (tradeControl.hasClass('trade-view-btn-open')) {
            tradeContentBlock.css('height', tBHeight + 40);
            tradeControl.removeClass('trade-view-btn-open');
        }
        else {
            tradeContentBlock.css('height', tCWHeight + 40);
            tradeControl.addClass('trade-view-btn-open');
        }
	});
	
	// Hide Top trader
	var tBHeight = tradeContentWrapper.children(0).outerHeight(true);

	// tradeContentBlock.css('height', tBHeight + 40);
	tradeControl.addClass('trade-view-btn-open');
	tradeContentBlock.css('height', tradeContentWrapper.outerHeight(true) + 40);
	
	// Hide & Unhide Report
    var reportContentWrapper = $('.report--wrapper'),
        reportContentContent = $('.report--content'),
        reportContentBlock = $('.report--block'),
        reportControl = $('.view-more-report'),
        reportControlVip = $('.view-more-report-vip');

    reportControl.click(function () {
        var rBHeight = reportContentContent.children(0).outerHeight(true),
			rCWHeight = reportContentContent.outerHeight(true);

			console.log(rBHeight);
			console.log(rCWHeight);

        if (reportControl.hasClass('active')) {
            if ($('html').outerWidth(true) > 1000) {
                reportContentWrapper.css('height', rBHeight + 20);
            }
            else if ($('html').outerWidth(true) < 1000) {
                reportContentWrapper.css('height', (rBHeight * 3) + 20);
            }
            reportControl.removeClass('active');
            reportControlVip.removeClass('active');
            reportContentWrapper.removeClass('active');
        }
        else {
            reportContentWrapper.css('height', rCWHeight + 10);
            reportControl.addClass('active');
            reportControlVip.addClass('active');
            reportContentWrapper.addClass('active');
        }
	});
	
	// Hide Report
	var rBHeight = reportContentBlock.outerHeight(true);

    if ($('html').outerWidth(true) > 1000) {
        reportContentWrapper.css('height', rBHeight + 20);
    }
    else if ($('html').outerWidth(true) < 1000) {
        reportContentWrapper.css('height', (rBHeight * 3) + 20);
	}
	
	// Добавление флагов к языкам
	$('.languages .languages__item').each(function() {
		var thisLang = $(this),
			thisLangSpan = thisLang.find('span'),
			thisLangSpanText = thisLang.find('span').text();
		
		if (thisLangSpanText == "RU") {
			thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"/><path style="fill:#0052B4;" d="M496.077,345.043C506.368,317.31,512,287.314,512,256s-5.632-61.31-15.923-89.043H15.923 C5.633,194.69,0,224.686,0,256s5.633,61.31,15.923,89.043L256,367.304L496.077,345.043z"/><path style="fill:#D80027;" d="M256,512c110.071,0,203.906-69.472,240.077-166.957H15.923C52.094,442.528,145.929,512,256,512z"/></svg>');
		}
		else if (thisLangSpanText == "EN") {
			thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"/><g><path style="fill:#0052B4;" d="M52.92,100.142c-20.109,26.163-35.272,56.318-44.101,89.077h133.178L52.92,100.142z"/><path style="fill:#0052B4;" d="M503.181,189.219c-8.829-32.758-23.993-62.913-44.101-89.076l-89.075,89.076H503.181z"/><path style="fill:#0052B4;" d="M8.819,322.784c8.83,32.758,23.993,62.913,44.101,89.075l89.074-89.075L8.819,322.784L8.819,322.784 z"/><path style="fill:#0052B4;" d="M411.858,52.921c-26.163-20.109-56.317-35.272-89.076-44.102v133.177L411.858,52.921z"/><path style="fill:#0052B4;" d="M100.142,459.079c26.163,20.109,56.318,35.272,89.076,44.102V370.005L100.142,459.079z"/><path style="fill:#0052B4;" d="M189.217,8.819c-32.758,8.83-62.913,23.993-89.075,44.101l89.075,89.075V8.819z"/><path style="fill:#0052B4;" d="M322.783,503.181c32.758-8.83,62.913-23.993,89.075-44.101l-89.075-89.075V503.181z"/><path style="fill:#0052B4;" d="M370.005,322.784l89.075,89.076c20.108-26.162,35.272-56.318,44.101-89.076H370.005z"/></g><g><path style="fill:#D80027;" d="M509.833,222.609h-220.44h-0.001V2.167C278.461,0.744,267.317,0,256,0 c-11.319,0-22.461,0.744-33.391,2.167v220.44v0.001H2.167C0.744,233.539,0,244.683,0,256c0,11.319,0.744,22.461,2.167,33.391 h220.44h0.001v220.442C233.539,511.256,244.681,512,256,512c11.317,0,22.461-0.743,33.391-2.167v-220.44v-0.001h220.442 C511.256,278.461,512,267.319,512,256C512,244.683,511.256,233.539,509.833,222.609z"/><path style="fill:#D80027;" d="M322.783,322.784L322.783,322.784L437.019,437.02c5.254-5.252,10.266-10.743,15.048-16.435 l-97.802-97.802h-31.482V322.784z"/><path style="fill:#D80027;" d="M189.217,322.784h-0.002L74.98,437.019c5.252,5.254,10.743,10.266,16.435,15.048l97.802-97.804 V322.784z"/><path style="fill:#D80027;" d="M189.217,189.219v-0.002L74.981,74.98c-5.254,5.252-10.266,10.743-15.048,16.435l97.803,97.803 H189.217z"/><path style="fill:#D80027;" d="M322.783,189.219L322.783,189.219L437.02,74.981c-5.252-5.254-10.743-10.266-16.435-15.047 l-97.802,97.803V189.219z"/></g></svg>');
		}
		else if (thisLangSpanText == "DE") {
			thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#FFDA44;" d="M15.923,345.043C52.094,442.527,145.929,512,256,512s203.906-69.473,240.077-166.957L256,322.783 L15.923,345.043z"/><path d="M256,0C145.929,0,52.094,69.472,15.923,166.957L256,189.217l240.077-22.261C459.906,69.472,366.071,0,256,0z"/><path style="fill:#D80027;" d="M15.923,166.957C5.633,194.69,0,224.686,0,256s5.633,61.31,15.923,89.043h480.155 C506.368,317.31,512,287.314,512,256s-5.632-61.31-15.923-89.043H15.923z"/></svg>');
		}
		else if (thisLangSpanText == "ZH") {
			thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve"><style type="text/css">.st0{fill:#D80027;}.st1{fill:#FFDA44;}</style><circle class="st0" cx="207" cy="397" r="256"/><g><polygon class="st1" points="91.1,296.8 113.2,364.8 184.7,364.8 126.9,406.9 149,474.9 91.1,432.9 33.2,474.9 55.4,406.9  -2.5,364.8 69,364.8 	"/><polygon class="st1" points="254.5,537.5 237.6,516.7 212.6,526.4 227.1,503.9 210.2,483 236.1,489.9 250.7,467.4 252.1,494.2  278.1,501.1 253,510.7 	"/><polygon class="st1" points="288.1,476.5 296.1,450.9 274.2,435.4 301,435 308.9,409.4 317.6,434.8 344.4,434.5 322.9,450.5  331.5,475.9 309.6,460.4 	"/><polygon class="st1" points="333.4,328.9 321.6,353 340.8,371.7 314.3,367.9 302.5,391.9 297.9,365.5 271.3,361.7 295.1,349.2  290.5,322.7 309.7,341.4 	"/><polygon class="st1" points="255.2,255.9 253.2,282.6 278.1,292.7 252,299.1 250.1,325.9 236,303.1 209.9,309.5 227.2,289  213,266.3 237.9,276.4 	"/></g></svg>');
		}
		else if (thisLangSpanText == "FR") {
			thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"/><path style="fill:#D80027;" d="M512,256c0-110.071-69.472-203.906-166.957-240.077v480.155C442.528,459.906,512,366.071,512,256z"/><path style="fill:#0052B4;" d="M0,256c0,110.071,69.473,203.906,166.957,240.077V15.923C69.473,52.094,0,145.929,0,256z"/></svg>');
		}
		else if (thisLangSpanText == "PL") {
			thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"/><path style="fill:#D80027;" d="M512,256c0,141.384-114.616,256-256,256S0,397.384,0,256"/></svg>');
		}
		// if (thisLangSpanText == "RU") {
		// 	thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><path style="fill:#F5F5F5;" d="M512,200.093H0V97.104c0-4.875,3.953-8.828,8.828-8.828h494.345c4.875,0,8.828,3.953,8.828,8.828 L512,200.093L512,200.093z"/><path style="fill:#FF4B55;" d="M503.172,423.725H8.828c-4.875,0-8.828-3.953-8.828-8.828V311.909h512v102.988 C512,419.773,508.047,423.725,503.172,423.725z"/><rect y="200.091" style="fill:#41479B;" width="512" height="111.81"/></svg>');
		// }
		// else if (thisLangSpanText == "EN") {
		// 	thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002;" xml:space="preserve"><path style="fill:#41479B;" d="M503.172,423.725H8.828c-4.875,0-8.828-3.953-8.828-8.828V97.104c0-4.875,3.953-8.828,8.828-8.828 h494.345c4.875,0,8.828,3.953,8.828,8.828v317.793C512,419.772,508.047,423.725,503.172,423.725z"/><path style="fill:#F5F5F5;" d="M512,97.104c0-4.875-3.953-8.828-8.828-8.828h-39.495l-163.54,107.147V88.276h-88.276v107.147 L48.322,88.276H8.828C3.953,88.276,0,92.229,0,97.104v22.831l140.309,91.927H0v88.276h140.309L0,392.066v22.831 c0,4.875,3.953,8.828,8.828,8.828h39.495l163.54-107.147v107.147h88.276V316.578l163.54,107.147h39.495 c4.875,0,8.828-3.953,8.828-8.828v-22.831l-140.309-91.927H512v-88.276H371.691L512,119.935V97.104z"/><g><polygon style="fill:#FF4B55;" points="512,229.518 282.483,229.518 282.483,88.276 229.517,88.276 229.517,229.518 0,229.518 0,282.483 229.517,282.483 229.517,423.725 282.483,423.725 282.483,282.483 512,282.483"/><path style="fill:#FF4B55;" d="M178.948,300.138L0.25,416.135c0.625,4.263,4.14,7.59,8.577,7.59h12.159l190.39-123.586h-32.428 V300.138z"/><path style="fill:#FF4B55;" d="M346.388,300.138H313.96l190.113,123.404c4.431-0.472,7.928-4.09,7.928-8.646v-7.258 L346.388,300.138z"/><path style="fill:#FF4B55;" d="M0,106.849l161.779,105.014h32.428L5.143,89.137C2.123,90.54,0,93.555,0,97.104V106.849z"/><path style="fill:#FF4B55;" d="M332.56 211.863L511.693,95.586c-0.744-4.122-4.184-7.309-8.521-7.309h-12.647L300.138,211.863 H332.566z"/></g></svg>');
		// }
		// else if (thisLangSpanText == "DE") {
		// 	thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><path style="fill:#464655;" d="M512,200.093H0V97.104c0-4.875,3.953-8.828,8.828-8.828h494.345c4.875,0,8.828,3.953,8.828,8.828 L512,200.093L512,200.093z"/><path style="fill:#FFE15A;" d="M503.172,423.725H8.828c-4.875,0-8.828-3.953-8.828-8.828V311.909h512v102.988 C512,419.773,508.047,423.725,503.172,423.725z"/><rect y="200.091" style="fill:#FF4B55;" width="512" height="111.81"/></svg>');
		// }
		// else if (thisLangSpanText == "ZH") {
		// 	thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><path style="fill:#FF4B55;" d="M503.172,423.725H8.828c-4.875,0-8.828-3.953-8.828-8.828V97.104c0-4.875,3.953-8.828,8.828-8.828 h494.345c4.875,0,8.828,3.953,8.828,8.828v317.793C512,419.773,508.047,423.725,503.172,423.725z"/><g><path style="fill:#FFE15A;" d="M85.007,140.733l8.416,25.234l26.6,0.206c3.444,0.026,4.872,4.422,2.101,6.467l-21.398,15.801 l8.023,25.362c1.038,3.284-2.7,5.999-5.502,3.997l-21.64-15.469l-21.64,15.468c-2.802,2.003-6.54-0.714-5.502-3.997l8.023-25.362 l-21.398-15.8c-2.771-2.046-1.343-6.441,2.101-6.467l26.6-0.206l8.416-25.234C79.297,137.465,83.918,137.465,85.007,14.733z"/><path style="fill:#FFE15A;" d="M181.599,146.951l6.035,8.23l9.739-3.046c1.261-0.394,2.298,1.044,1.526,2.115l-5.962,8.281 l5.906,8.321c0.765,1.077-0.282,2.508-1.54,2.105l-9.719-3.111l-6.089,8.189c-0.788,1.06-2.473,0.506-2.478-0.814l-0.045-10.205 l-9.67-3.261c-1.251-0.423-1.246-2.195,0.009-2.609l9.69-3.196l0.114-10.204C179.129,146.427,180.818,145.886,181.599,14.951z"/><path style="fill:#FFE15A;" d="M144.857,122.421l10.145,1.102l4.328-9.241c0.561-1.196,2.321-0.991,2.591,0.302l2.086,9.988 l10.126,1.26c1.311,0.163,1.66,1.901,0.513,2.558l-8.855,5.07l1.931,10.02c0.25,1.298-1.295,2.166-2.274,1.279l-7.559-6.855 l-8.932,4.932c-1.156,0.639-2.461-0.563-1.919-1.768l4.183-9.308l-7.452-6.972C142.805,123.89,143.544,122.279,144.857,12.421z"/><path style="fill:#FFE15A;" d="M160.895,221.314l-6.035,8.23l-9.739-3.046c-1.261-0.394-2.298,1.044-1.526,2.115l5.962,8.281 l-5.906,8.321c-0.765,1.077,0.282,2.508,1.54,2.105l9.719-3.111l6.089,8.189c0.788,1.06,2.473,0.506,2.478-0.814l0.045-10.205 l9.67-3.261c1.252-0.423,1.246-2.195-0.009-2.609l-9.69-3.196l-0.114-10.204C163.363,220.791,161.676,220.248,160.895,22.314z"/><path style="fill:#FFE15A;" d="M197.635,198.263l-10.145,1.102l-4.328-9.241c-0.561-1.196-2.321-0.991-2.591,0.302l-2.087,9.988 l-10.126,1.26c-1.311,0.163-1.66,1.901-0.513,2.558l8.855,5.07l-1.931,10.02c-0.25,1.298,1.295,2.166,2.274,1.279l7.559-6.855 l8.932,4.932c1.156,0.639,2.461-0.563,1.919-1.768l-4.183-9.308l7.452-6.972C199.689,199.732,198.95,198.121,197.635,198.263z"/></g></svg>');
		// }
		// else if (thisLangSpanText == "FR") {
		// 	thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#41479B;" d="M170.667,423.721H8.828c-4.875,0-8.828-3.953-8.828-8.828V97.1c0-4.875,3.953-8.828,8.828-8.828 h161.839V423.721z"/><rect x="170.67" y="88.277" style="fill:#F5F5F5;" width="170.67" height="335.45"/><path style="fill:#FF4B55;" d="M503.172,423.721H341.333V88.273h161.839c4.875,0,8.828,3.953,8.828,8.828v317.793 C512,419.77,508.047,423.721,503.172,423.721z"/></svg>');
		// }
		// else if (thisLangSpanText == "PL") {
		// 	thisLang.append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><path style="fill:#FF4B55;" d="M0,256h512v158.897c0,4.875-3.953,8.828-8.828,8.828H8.828c-4.875,0-8.828-3.953-8.828-8.828V256z"/><path style="fill:#F5F5F5;" d="M512,256H0V97.103c0-4.875,3.953-8.828,8.828-8.828h494.345c4.875,0,8.828,3.953,8.828,8.828L512,256 L512,256z"/></svg>');
		// }
	});
});

// Add files from form
function previewFile(n) {
	var fileBlock   = document.querySelectorAll('.file-block')[n],
		file 		= fileBlock.querySelector('input[type=file]').files[0],
		fileImg 	= fileBlock.querySelector('label').querySelector('img'),
		reader 		= new FileReader();
		
	file ? reader.readAsDataURL(file) : fileImg.src  = "";
	
	reader.onloadend = function () {
		fileImg.src  = reader.result;
		fileBlock.querySelector('label').querySelector('small').style.opacity = 0;
		fileBlock.querySelector('small.remove-file').classList.add('remove-file--view');
	}
}

// Remove files from form
function removeLoadFile(n) {
	var fileBlock     = document.querySelectorAll('.file-block')[n],
		fileLoadedImg = fileBlock.querySelector('img');

		fileLoadedImg.src = "";
		fileBlock.querySelector('label').querySelector('small').style.opacity = 1;
		fileBlock.querySelector('small.remove-file').classList.remove('remove-file--view');
}

// New motivation system
(function(){
    "use strict";

    // Offer's wrapper
	const wrapper = $(".wrapper--offers");
	
	if (typeof(wrapper) != 'undefined' && wrapper != null) {
		// Offer block
		let offer = wrapper.find(".offer-block");

		const offerChange = (n) => {
			let elem = wrapper.find(".offer-block");

			n == offer.length ? n = 0 : n = n;

			elem.eq(n).addClass("active");
		}
		
		// Offer block each
		offer.each(function(){
			// Set this
			let thisElem = $(this);
			// Find control button
			let nextBtn  = thisElem.find(".ob-control button.up");
			let prevBtn  = thisElem.find(".ob-control button.down");

			// Active offer element index
			let active   = thisElem.index();

			nextBtn.on("click", () => {
				thisElem.removeClass("active");

				offerChange(active - 1);
			});
			prevBtn.on("click", () => {
				thisElem.removeClass("active");

				offerChange(active + 1);
			});
		});
	}
}());

// New modal window system
(function(){
    "use strict";

	// About button
	let aboutBtn = $("button.mw-control-btn");
	
	if (typeof(aboutBtn) != 'undefined' && aboutBtn != null) {

		// Get data class for find
		let findClass = String(aboutBtn.data("findmodal"));
		
		if (typeof(findClass) != 'undefined' && findClass != null) {
			// Modal window
			let mw = $(`section.${findClass}`);
			// Close button
			let close = mw.find("button.close");

			// Open modal window
			aboutBtn.on("click", () => {
				// Add 'active' class on modal window
				mw.addClass("active");

				$("body").addClass("block");
			});

			// Close modal window
			close.on("click", () => {
				// Remove 'active' class on modal window
				mw.removeClass("active");

				$("body").removeClass("block");
			});
		}
	}

}());
