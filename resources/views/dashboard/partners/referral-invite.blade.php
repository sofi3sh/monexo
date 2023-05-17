<form id="referralInviteForm" action="{{route('home.referral-invite')}}" method="post">
    @csrf
    <div class="form-group">
        <div class="input-group d-flex justify-content-space-between p-0 m-0">
            <input type="email" class="form-control mr-3" name="invite-referral-email" id="referral-email" placeholder="name@example.com">
            <button type="submit" class="btn btn-success pl-3 pr-3">@lang('base.dash.partners.user-invite.btns.send')</button>
        </div>
        <div class="invalid-feedback d-block"></div>
    </div>
    <!-- <div id="deposit"></div> -->
    <div class="d-flex align-items-center">
        
<!--                 <button id="btn-dep" data-dep="false" type="button" class="btn btn-sm btn-secondary">@lang('base.dash.partners.user-invite.btns.add-dep')</button>
-->            </div>
</form>

<script defer>
    const packages = getPackages();
    const inviteCommission = {!! json_encode($inviteCommission) !!} ?? 3;
    //const $depositBlock = $('#deposit');
    const $inviteForm = $('#referralInviteForm');
    let selectPackage;

    $inviteForm
        //  .on('click', function (e) {
        //     const $target = $(e.target);

        //     if($target.attr('id') == 'btn-dep') {
        //         if($target.attr('data-dep') == 'false') {
        //             const targetText = "{{__('base.dash.partners.user-invite.btns.remove-dep')}}";
        //             setDepositBlock($target, getDepositContent(), targetText, true)
        //         }
        //         else {
        //             const targetText = "{{__('base.dash.partners.user-invite.btns.add-dep')}}";
        //             setDepositBlock($target, '', targetText, false)
        //         }
        //     }
        // }) 

        .on('change', function(e) {
            const $target = $(e.target);
            selectPackage = $target.val();

            if($target.attr('id') == 'package') {
                const val = $target.val();
                const $btn = $inviteForm.find('[type="submit"]');

                if(val) {
                    const label = `<label class="text-white d-block">{{__('base.dash.partners.user-invite.sum')}}</label>`;
                    $('#amount-block').html(label + packageFunctions[$target.val()]());
                }
                else {
                    $('#amount-block').html('')
                }
            }
        })

        .on('input', function(e) {
            const $target = $(e.target);
            const id = $target.prop('id');
            showErorrs(id);

            if(id === 'deposit-amount') {
                $('#real-sum').text($target.val() * (1 + inviteCommission / 100 ));
            }
        })

        .on('submit', function(e) {
            const hasErorrs = showErorrs();

            if(hasErorrs) {
                e.preventDefault();
            }
        });


    /* function setDepositBlock($target, content, targetText, dataDepVal) {
        $depositBlock.html(content);
        $target.text(targetText);
        $target.attr('data-dep', dataDepVal);
    } */

    function getInput(packageName) {

        const {min_invest_sum, max_invest_sum} = packages[packageName];

        return `<div class="form-group">
                    <div class="input-group">
                        <input data-package="${packageName}" id="deposit-amount" class="form-control" type="number" min="${min_invest_sum}" max="${max_invest_sum}" name="deposit-amount" placeholder="100">
                    </div>
                    <div class="invalid-feedback d-block"></div>
                    <small class="form-text text-white">
                        Будет снято со счета: $<span id="real-sum">0</span>
                    </small>
                    <small id="transfer_amount_help" class="form-text text-muted">
                        Комиссия: ${inviteCommission}% {{__('base.dash.partners.user-invite.min')}} - $${min_invest_sum}. {{__('base.dash.partners.user-invite.max')}} - $${max_invest_sum}
                    </small>
                </div>`
    }

    function getDepositContent() {
        const options = Object.values(packages).map(package => `<option value="${package.id}">${package.name}</option>`).join('');

        return `<div class="form-group">
                    <label class="text-white" for="package">{{__('base.dash.partners.user-invite.package')}}</label>
                    <div class="input-group">
                        <select id="package" name="package" class="form-control">
                            <option value="">{{__('base.dash.partners.user-invite.not-chosen')}}</option>
                            ${options}
                        </select>
                    </div>
                    <div class="invalid-feedback d-block"></div>
                </div>
                <div id="amount-block" class="mb-3"></div>`;
    }

    const packageFunctions = {
        '24': () => getInput('24'),
        '26': () => getInput('26'),
    }

    function getPackages() {
        const p = {!! json_encode($packages) !!};
        const packages = {};
        for(let key in p) {
            packages[p[key].id] = p[key];
        }
        return packages;
    }

    // Валидация
    const printError = ($errorBox, $inputGroup, text) => {
        $inputGroup.addClass('border border-danger');
        $errorBox.text(text);
    };

    const removeError = ($errorBox, $inputGroup) => {
        if($inputGroup.hasClass('border border-danger')) {
            $inputGroup.removeClass('border border-danger');
        }
        $errorBox.text('');
    };

    const amountValidate = (value, packageName) => {

        const {min_invest_sum, max_invest_sum} = packages[packageName];

        const balance = "{{Auth::user()->balance_usd}}";

        if(!/[0-9.]/igm.test(value)) {
            return "{{__('base.dash.partners.errors.format')}}";
        }
        else if(value > +balance) {
            return "{{__('base.dash.partners.errors.balance')}}";
        }
        else if(value < min_invest_sum) {
            return `{{__('base.dash.partners.errors.min')}} - $${min_invest_sum}`;
        }
        else if(value > max_invest_sum) {
            return `{{__('base.dash.partners.errors.max')}} - $${max_invest_sum}`;
        }

        return -1;
    }

    const required = value => {
        return value ? -1 : "{{__('base.dash.partners.errors.required')}}";
    }

    const emailValidate = value =>  {
        const isValid = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm.test(value);
        return isValid ? -1 : "{{__('base.dash.balance.custom_translations.errors.email')}}";
    }

    const erorrsFunctions = {
        'deposit-amount': (value, packageName) => amountValidate(value, packageName),
        'referral-email': (value, packageName) => emailValidate(value),
        'package': (value, packageName) => required(value)
    };

    const showErorrs = (currentId = null) => {
        let errors = [];

        for(let key in erorrsFunctions) {
            let $el = $('#' + key);

            if($el.length) {
                let $inviteFormGroup = $el.closest('.form-group');
                let $inputGroup = $el.closest('.input-group');
                let $errorBox = $inviteFormGroup.find('.invalid-feedback');
                let packageName = $el.data('package');
                let value = erorrsFunctions[key]($el.val(), packageName);

                if(value !== -1) {
                    errors.push(value);

                    if(key == currentId  || currentId == null ) {
                        printError($errorBox, $inputGroup, value);
                    }

                }
                else {
                    removeError($errorBox, $inputGroup);
                }
            }
        }
        return !!errors.length;
    };
</script>