$(function() {
    const forms = [ $('#form-register'), 
                    $('#form-auth'), 
                    $('#form-reset-password'), 
                    $('#main-settings-form'),
                    $('#passwords-settings-form')
                ];

    // lang settings
    const langPath = 'validation.js-lang';
    const langWordCount = langPath + '.wordCountValidate';
    const langEmail = langPath + '.emailValidation';
    const langSame = langPath + '.sameValidate';
    const langDate = langPath + '.dateValidate';
    const langFields = langPath + '.fields';
    const lang = {
        current: trans(`${langPath}.current`),
        wordCountValidate: {
            'count': trans(`${langWordCount}.count`),
            'must': trans(`${langWordCount}.must`),
            'equal': trans(`${langWordCount}.equal`),
            'inrange': trans(`${langWordCount}.inrange`),
            'to': trans(`${langWordCount}.to`),
        },
        emailValidation: {
            'email': trans(`${langEmail}.email`),
        },
        sameValidate: {
            'notsame': trans(`${langSame}.notsame`),
        },
        dateValidate: {
            'plus18': trans(`${langDate}.plus18`),
            'format': trans(`${langDate}.format`),
        },
        formRulesUse : trans(`${langPath}.formRulesUse`),
        fields: {
            name: trans(`${langFields}.name`),
            surname: trans(`${langFields}.surname`),
            country: trans(`${langFields}.name`),
            city: trans(`${langFields}.city`),
            phone: trans(`${langFields}.phone`),
            password: trans(`${langFields}.password`),
            passwords: trans(`${langFields}.passwords`),
        } 
    }

    const countries = ['ru', 'kz', 'ua', 'by', 'us', 'gb', 'uz', 'kg', 'ge', 'md'];

    const countriesMap = {
        'Russia':         'ru',
        'Kazakhstan':     'kz',
        'Ukraine':        'ua',
        'Belarus':        'by',
        'United States':  'us',
        'United Kingdom': 'gb',
        'Uzbekistan':     'uz',
        'Kyrgyzstan':     'kg',
        'Georgia':        'ge',
        'Moldova':        'md'
    }

    const printError = ($errorBox, $inputGroup  = null, text) => {
        $inputGroup.addClass('has-error');
        $errorBox.text(text);
    }

    const removeEror = ($errorBox, $inputGroup) => {
        if($inputGroup.hasClass('has-error')) {
            $inputGroup.removeClass('has-error');
        }
        $errorBox.text('');
    }

    const wordCountValidate = props => {
        const {value, name, min = 2, max = 50, fix = null} = props;
        const {equal, count, must, inrange, to} = lang.wordCountValidate;
        const startText = `${count} \"${name}\" ${must}`;
        const length = value.length;
        let error;

        if(fix) {
            error = `${startText} ${equal} ${fix}`;
        }
        else if(length < min || length > max) {
            error = `${startText} ${inrange} ${min} ${to} ${max}`;
        }
        else {
            error = -1;
        }

        return error;
    }

    const emailValidation = value => {
        let isValid = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm.test(value);
        return isValid ? -1 : lang.emailValidation.email;
    }

    const sameValidate = (value, selector, name) => {
        let isValid = $(selector).prop('value') == value;
        return isValid ? -1 : `${name} ${lang.sameValidate.notsame}`;
    }

    const checkedValidate = checked => checked ? -1 : lang.formRulesUse;

    const dateValidate = value => {
        let {plus18, format} = lang.dateValidate;
        let isValid = /^\d{2}[.]\d{2}[.]\d{4}$/.test(value);
       
        if(isValid) {
            let [day, month, year] = value.split('.');
            let is18plus = (new Date(+year + 18, month - 1, +day)) <= new Date();
            
            if(!is18plus) {
                return plus18;
            }

        } else {
            return format;
        }

        return -1;
    }

    const {name, surname, city, password, passwords} = lang.fields;
    
    const erorrsFunctions = {
        'form-name': value => wordCountValidate({
                value, 
                name: name, 
                max: 150
            }
        ),
        'form-surname': value => wordCountValidate({
                value, 
                name: surname, 
                max: 150
            }
        ),
        'form-email': value => emailValidation(value),
        'form-country': value => wordCountValidate( {
                value,
                name: lang.fields.country
            }
        ),
        'form-city': value => wordCountValidate( {
                value,
                name: city
            }
        ),
        'form-phone': value => wordCountValidate({
            value,
            name: lang.fields.phone,
            min: 8,
            max: 16
        }),
        // 'form-age': value =>  ageValidation(value, 18),
        'form-password': value => wordCountValidate({
            value,
            name: password,
            min: 8,
            max: 40
        }),
        'form-password-confirm': value => sameValidate(value, '#form-password', passwords),
        'form-rules-use': value => checkedValidate(value),
        'form-birthday': value => dateValidate(value)
    };

    const inputCity = document.querySelector('#form-city');
            
    const settings = {
        input: inputCity,
        className: 'form-sities-container',
        onSelect: item => inputCity.value = item.label
    }
    
    /*  Function remove all errors if not found. 
        Return true if errors not found else return false.
    */
    const formCheckErrors = ($form) => {
        const errors = [];
        
        for(let id in erorrsFunctions) {
            
            let $target = $form.find('#' + id);
            
            if($target.length) {
                const $formGroup = $target.closest('.form-group');
                const $inputGroup = $formGroup.find('.input-group');
                const $errorBox = $formGroup.find('.invalid-feedback');
                let value = $target.prop('value');
                
                if($target.prop('type') === 'checkbox') {
                    value = $target.prop('checked');
                }

                if(id in erorrsFunctions) {
                    let er = erorrsFunctions[id](value);
                    er !== -1 ? errors.push(er) : removeEror($errorBox, $inputGroup);
                }
            }
        }

        return !errors.length;
    }

    const showErrors = $form => {
        
        for(let id in erorrsFunctions) {
            
            let $target = $form.find('#' + id);
            
            if($target.length) {
                const $formGroup = $target.closest('.form-group');
                const $inputGroup = $formGroup.find('.input-group');
                const $errorBox = $formGroup.find('.invalid-feedback');
                let value = $target.prop('value');
                
                if($target.prop('type') === 'checkbox') {
                    value = $target.prop('checked');
                }

                if(id in erorrsFunctions) {
                    let er = erorrsFunctions[id](value);
                    er !== -1 ? printError($errorBox, $inputGroup, er) : removeEror($errorBox, $inputGroup);
                }
            }
        }
    }

    function formOnInputValidate($form) {
        const $formSubmit = $form.find('[type="submit"]');

        $form.on('input', function(e) {
            const $target = $(e.target);
            const $formGroup = $target.closest('.form-group');
            const $inputGroup = $formGroup.find('.input-group');
            const $errorBox = $formGroup.find('.invalid-feedback');
            let value = $target.prop('value');

            if($target.prop('type') === 'checkbox') {
                value = $target.prop('checked');
            }
            const id = $target.prop('id');
            
            let error;
            
            if(id in erorrsFunctions) {
                error = erorrsFunctions[id](value);
            }
            
            if(error != -1 && error != null) {
                printError($errorBox, $inputGroup, error);
            }
            else {
                removeEror($errorBox, $inputGroup)
            }

            
            if(formCheckErrors($form)) // true if errors not found
            {
                $formSubmit.removeClass('disabled');
            } else {
                $formSubmit.addClass('disabled');
            }
        });

        $form.on('change', function(e) {
            const $target = $(e.target);
            
            if($target.prop('id') === 'form-birthday') {
                let value = $target.prop('value');
                const $formGroup = $target.closest('.form-group');
                const $inputGroup = $formGroup.find('.input-group');
                const $errorBox = $formGroup.find('.invalid-feedback');
                const error = erorrsFunctions[$target.prop('id')](value);

                if(error != -1) {
                    printError($errorBox, $inputGroup, error);
                }
                else {
                    removeEror($errorBox, $inputGroup);
                }
            }
        })
    }


    $.fn.datepicker.dates['ru'] = {
        clear: 'очистить',
        days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
        daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
        daysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
        months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
        monthsShort: ["Янв", "Фев", "Март", "Апр", "Май", "Июнь", "Июль", "Авг", "Сен", "Окт", "Нояб", "Дек"],
        titleFormat: "MM yyyy",
        today: 'Сегодня',
        weekStart: 1
    }

    $('#form-birthday')
        .datepicker({
            isRTL: false,
            endDate: '-18y',
            language: lang.current,
            format: 'dd.mm.yyyy'
        })
        .on('changeDate', function() {
            $form = $('#form-birthday').closest('form')
            $formSubmit = $form.find('[type="submit"]');
            
            if(formCheckErrors($form)) // true if errors not found
            {
                $formSubmit.removeClass('disabled');
            } else {
                $formSubmit.addClass('disabled');
            }

            formCheckErrors($form);
        });

    $('#form-birthday-anket')
        .datepicker({
            isRTL: false,
            endDate: '-18y',
            language: lang.current,
            format: 'dd.mm.yyyy'
        })
        .on('changeDate', function() {
            $form = $('#form-birthday').closest('form')
            $formSubmit = $form.find('[type="submit"]');
            
            if(formCheckErrors($form)) // true if errors not found
            {
                $formSubmit.removeClass('disabled');
            } else {
                $formSubmit.addClass('disabled');
            }

            formCheckErrors($form);
        });

    
    $formPassword = $('#form-password');
    
    $formPassword.on('input', function() {
        let value = $formPassword.prop('value');
        let disabled = erorrsFunctions['form-password'](value) === -1 && $formPassword.prop('value') != '';
        let $formConfirm  = $('#form-password-confirm');
        
        if(value === '') {
            $formConfirm.val('');
        }
        
        $formConfirm.prop('disabled', !disabled);
    });

    forms.forEach($form =>  {
        const $formSubmit = $form.find('[type="submit"]');
        
        $formSubmit.on('click', function(e) {
            if(!formCheckErrors($form)) {
                e.preventDefault();
                showErrors($form);
            } 
        });

        if(formCheckErrors($form)) // true if errors not found
        {
            $formSubmit.removeClass('disabled');
        } else {
            $formSubmit.addClass('disabled');
        }
    });

    forms.forEach($form => formOnInputValidate($form));

    const contents = {
        country: `<div class="iti-form-country">
                    <label class="form-control-label" for="form-country">${trans('base.dash.profile.country')}</label>
                    <div class="d-flex align-items-center">
                        <input id="form-country" name="country" class="form-control flex-grow-1" type="text" readonly>
                        <button type="button" data-form-trigger="btn-cancel" class="btn btn-secondary ml-2">${trans('base.dash.btns.cancel')}</button>
                    </div>
                    <span class="invalid-feedback d-block"></span>
                </div>`,
        phone: `
                    <label class="form-control-label" for="form-phone">${trans('base.dash.profile.phone')}</label>
                    <div class="d-flex align-items-center">
                        <input id="form-phone" class="form-control" type="text">
                        <button type="button" data-form-trigger="btn-cancel" class="btn btn-secondary ml-2 mr-0">${trans('base.dash.btns.cancel')}</button>
                        <input type="hidden" id="form-phone-hidden" name="phone" class="form-control" type="text">
                    </div>
                    <span class="invalid-feedback d-block"></span>
                `
    }
    
    const $triggers = $('[data-form-trigger="main"]');

    const intlTelInputSettings = {
        initialCountry: 'auto',
        geoIpLookup: function(callback) {
            $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "ru";
            callback(countryCode);
            });
        },
        utilsScript: '/js/utils.js',
        separateDialCode: true,
        preferredCountries: ['ru', 'kz', 'ua', 'by', 'us', 'gb', 'uz', 'kg', 'ge', 'md']
    };
    
    $triggers.each((index, main) => {
        const $main = $(main);
        
        const $btnTrigger = $main.find('[data-form-trigger="btn-trigger"]');
        
        if($btnTrigger.length > 0) {
            $btnTrigger.on('click', function() {
                
                const $triggerContainer = $main.find('[data-form-trigger="trigger-container"]');
                const $triggerInputContainer = $main.find('[data-form-trigger="input-container"]');
                const contentType = $triggerInputContainer.data('content');

                $triggerContainer.addClass('d-none');
                $triggerContainer.removeClass('d-flex');
    
                contents[contentType + 'First'] = $triggerInputContainer.html();
                $triggerInputContainer.html(contents[contentType]);
                $triggerInputContainer.addClass('d-block');
                startTrigger($main);
            });
        }
    });

    function startTrigger($main) {
        
        const $btnTrigger = $main.find('[data-form-trigger="btn-trigger"]');

        if($btnTrigger.length > 0) { 
            
            const $btnCancel = $main.find('[data-form-trigger="btn-cancel"]');
            const $triggerContainer =  $main.find('[data-form-trigger="trigger-container"]');
            const $triggerInputContainer = $main.find('[data-form-trigger="input-container"]');
            const contentType = $triggerInputContainer.data('content');

            $btnCancel.on('click', function() {
                $triggerInputContainer.html(contents[contentType + 'First']);
                $triggerInputContainer.removeClass('d-block');
                
                $triggerContainer.removeClass('d-none');
                $triggerContainer.addClass('d-flex');
            });
        }

        startCountry();
        startPhone();
        startCities();
    }

    function startCountry() {
        
        const $formCountry = $('#form-country');
        
        if($formCountry.length > 0) {

            $formCountry.intlTelInput({
                ...intlTelInputSettings,
                separateDialCode: false,
            });
    
            const country = $formCountry.intlTelInput("getSelectedCountryData").name;
    
            $formCountry.val(country);
    
            $formCountry.on('countrychange', function() {
                const country = $formCountry.intlTelInput("getSelectedCountryData").name;
                $formCountry.val(country);
            });
        }
        
    }

    function startPhone() {
        
        $formPhone = $('#form-phone');
        
        if($formPhone.length > 0) {
            
            $formPhone
                .intlTelInput(intlTelInputSettings)
                .on('input', e => {
                    e.target.value = e.target.value.replace(/\D/g, '');
                    const num = $formPhone.intlTelInput("getNumber");
                    $('#form-phone-hidden').val(num);
                });
        }

        $formPhone2 = $('#form-phone_anket');
        
        if($formPhone2.length > 0) {
            
            $formPhone2
                .intlTelInput(intlTelInputSettings)
                .on('input', e => {
                    e.target.value = e.target.value.replace(/\D/g, '');
                    const num = $formPhone2.intlTelInput("getNumber");
                    $('#form-phone-hidden2').val(num);
                });
        }
    }

    async function getCities(country) {
        const response = await fetch(`/cities/${country}`);
    
        if (response.ok) {
            let json = await response.json();
            return json;
        } else {
            console.log("Ошибка HTTP: " + response.status);
        }
        
    }

    startCountry();
    startPhone();
    startCities();
    
    if(window.userCountry) {
        (async () => {
            if(!countries.includes(countriesMap[userCountry])) return;
            let cities = await getCities(countriesMap[userCountry]);
        
            autocomplete({
                ...settings,
                fetch: function(text, update) {
                    text = text.toLowerCase();
                    let suggestions = cities.filter(city => city.label.toLowerCase().startsWith(text));
                    update(suggestions);
                }
            });
        })();
    }
    

    function startCities() {
        
        if($('#form-city').length > 0) {
            
            const $countryInput = $('#form-country');

            $countryInput.on('countrychange', async function() {
                let country = $countryInput.intlTelInput("getSelectedCountryData").iso2;
                if(!countries.includes(country)) return;
                let cities = await getCities(country);
                
                autocomplete({
                    ...settings,
                    fetch: function(text, update) {
                        text = text.toLowerCase();
                        let suggestions = cities.filter(city => city.label.toLowerCase().startsWith(text));
                        update(suggestions);
                    }
                });
            });
        }
    }
});


    

 