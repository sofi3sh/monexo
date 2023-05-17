<h2 class="h2">@lang('base.dash.balance.custom_translations.title')</h2>
<form id="customTransactionForm"  method="post" action="{{route('home.balance')}}" class="py-3">
    @csrf
    <div class="form-group">
        <label for="user_email">@lang('base.dash.balance.custom_translations.email')</label>
        <div class="input-group">
            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" required>
        </div>
        <div class="invalid-feedback d-block"></div>
    </div>
    <div class="form-group">
        <label for="transfer_amount">@lang('base.dash.balance.custom_translations.sum')</label>
        <div class="input-group">
            <input type="number" 
                class="form-control" 
                name="transfer_amount" 
                id="transfer_amount" 
                aria-describedby="transfer_amount_help" 
                placeholder="0.00" 
                required>
        </div>
        <div class="invalid-feedback d-block"></div>
        <div class="text-sm form-text mb-2">@lang('base.dash.balance.custom_translations.will-be-translated') <span id="will-be-translated">$0</span></div>
        <small id="transfer_amount_help" class="form-text text-muted">
            @lang('base.dash.balance.custom_translations.warning', [
                'commission' => $userToUserCommission,
                'min' => $userToUserMin,
                'max' => $userToUserMax
            ])
        </small>
    </div>
    <button id="customTransactionFormBtn" type="button" class="btn btn-primary disabled">@lang('base.dash.balance.custom_translations.btns.send')</button>
</form>

<script defer>
    const min = {{$userToUserMin}}, 
        max = {{$userToUserMax}}, 
        balance = {{$currentBalance}}

    const $form = $('#customTransactionForm');
    const $btn = $('#customTransactionFormBtn');
    const $finalSumFormEl = $('#will-be-translated');

    const printError = ($errorBox, $inputGroup, text) => {
        $inputGroup.addClass('border border-danger');
        $errorBox.text(text);
    }

    const removeEror = ($errorBox, $inputGroup) => {
        if($inputGroup.hasClass('border border-danger')) {
            $inputGroup.removeClass('border border-danger');
        }
        $errorBox.text('');
    }

    const emailValidate = value =>  {
        const isValid = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm.test(value);
        return isValid ? -1 : "{{__('base.dash.balance.custom_translations.errors.email')}}";
    }

    const amountValidate = (value, min, max, balance) => {
        
        if(!/[0-9.]/igm.test(value)) {
            return "{{__('base.dash.balance.custom_translations.errors.format')}}";
        }
        else if(value > balance) {
            return "{{__('base.dash.balance.custom_translations.errors.balance')}}";
        }
        else if(value < min) {
            return "{{__('base.dash.balance.custom_translations.errors.min')}}" + min;
        }
        else if(value > max) {
            return "{{__('base.dash.balance.custom_translations.errors.max')}}" + max;
        }

        return -1;
    }

    const erorrsFunctions = {
        'transfer_amount': value => amountValidate(value, min, max, balance),
        'user_email': value => emailValidate(value)
    };

    const showErorrs = (currentId = null) => {
        let errors = [];

        for(let key in erorrsFunctions) {
            let $el = $('#' + key);
            let $formGroup = $el.closest('.form-group');
            let $inputGroup = $el.closest('.input-group');
            let $errorBox = $formGroup.find('.invalid-feedback');
            let value = erorrsFunctions[key]($el.val());
            
            if(value !== -1) {
                errors.push(value);
                
                if(key == currentId  || currentId == null ) {
                    printError($errorBox, $inputGroup, value);
                }

            }
            else {
                removeEror($errorBox, $inputGroup);
            }
        }

        return !!errors.length;
    }

    $form.on('input', function(e) {
        const $target = $(e.target);
        const targetId = $target.prop('id');
        const hasError = showErorrs(targetId);
        
        hasError ? $btn.addClass('disabled') : $btn.removeClass('disabled');

        if(targetId === 'transfer_amount') {
            let sum = Math.trunc(parseFloat($target.val()) * {{ 1 - $userToUserCommission / 100}} * 100) / 100;
            let text = '$' + (isNaN(sum) ? 0 : sum);
            $finalSumFormEl.text(text);
        }

    });

    $btn.on('click', function() {
        const hasErrors = showErorrs();
        
        if(!hasErrors) {
            $('#userToUserModalConfirm').modal('show');
        }

        const $sumInput = $('#transfer_amount');
        const $finalSumEl = $('#userToUserFinalSum');
        const text = '$' + Math.trunc(parseFloat($sumInput.val()) * {{ 1 - $userToUserCommission / 100}} * 100) / 100;
        $finalSumEl.text(text);
        $finalSumFormEl.text(text);
    });
        
</script>
