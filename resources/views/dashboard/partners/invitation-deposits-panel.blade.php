<div id="invitation-deposit-panel" class="card bg-default shadow">
    <div class="card-header bg-transparent border-0">
        <h3 class="text-white mb-0">@lang('base.dash.menu.invitation_deposits')</h3>

        <form method="post" action="{{ route('home.partner.invitation-deposit.create') }}" id="invitation-deposit-panel--form" class="form-inline mt-3">
            @csrf

            <div class="input-group input-group-sm mb-2 mr-sm-2">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="@lang('base.dash.partners.email')" style="height: 3.1em;" required>
            </div>

            <div class="input-group input-group-sm mb-2 mr-sm-2">
                <select class="form-control" style="height: 3.1em;">
                    <option selected disabled value="">@lang('Select from list')</option>

                    @foreach($usersForInvitationDeposit as $user)
                        <option value="{{ $user['email'] }}"{{ old('email') === $user['email'] ? ' selected' : '' }}>
                            {{ $user['email'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="invitation-deposit-panel--submit">
                <button type="submit" name="stats" value="1" class="btn btn-success mb-2" disabled>@lang('Send invitation')</button>
                <small></small>
            </div>
        </form>

        <div id="invitation-deposit-panel--hint" class="mt-3">
            <small>@lang('Attention! You cannot use invitation deposits for your own benefit and send invitations to your own mail.<br>The platform administration monitors compliance with the rules and reserves the right to block the accounts of unscrupulous users')</small>
        </div>
    </div>
</div>

<script type="text/javascript">
    const InvitationDepositsForm = {
        data: {
            users: {!! json_encode($usersForInvitationDeposit, JSON_UNESCAPED_UNICODE) !!}
        },
        elements: {
            formElement: document.querySelector('#invitation-deposit-panel--form'),
            emailInput: document.querySelector('#invitation-deposit-panel--form input[type=email]'),
            emailSelect: document.querySelector('#invitation-deposit-panel--form select'),
            formSubmit: document.querySelector('#invitation-deposit-panel--form button[type=submit]'),
            submitHint: document.querySelector('#invitation-deposit-panel--submit > small')
        },
        findUserByEmail(email) {
            return this.data.users.find(user => user.email === email);
        },
        updateSubmit({text = '@lang('Send invitation')'} = {}) {
            this.elements.formSubmit.innerText = text;
            this.elements.formSubmit.disabled = !this.isSubmitAllowed();
        },
        isSubmitAllowed() {
            return this.elements.emailInput.checkValidity();
        },
        inputListener({target}) {
            const user = this.findUserByEmail(target.value),
                payload = {};

            if (user) {
                this.elements.emailSelect.value = user.email;
                this.elements.submitHint.innerText = user.name;

                payload.text = '@lang('Open deposit for partner')';
            } else {
                this.elements.emailSelect.value = '';
                this.elements.submitHint.innerText = '';
            }

            this.updateSubmit(payload);
        },
        selectListener({target}) {
            this.elements.emailInput.value = this.elements.emailSelect.value;
            this.elements.submitHint.innerText = this.findUserByEmail(target.value).name;

            this.updateSubmit({text: '@lang('Open deposit for partner')'});
        },
        submitListener(event) {
            const email = this.elements.emailInput.value.trim();

            if (!email || !this.isSubmitAllowed()) {
                event.preventDefault();

                return;
            }

            this.elements.emailInput.readOnly = true;
            this.elements.emailSelect.disabled = true;
            this.elements.formSubmit.disabled = true;
        },
        mounted() {
            this.elements.emailInput.addEventListener('input', event => this.inputListener(event));
            this.elements.emailSelect.addEventListener('change', event => this.selectListener(event));
            this.elements.formElement.addEventListener('submit', event => this.submitListener(event));

            // Если значения будут заполнены изначально
            this.updateSubmit();
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        InvitationDepositsForm.mounted();
    });

</script>

<style type="text/css">
    #invitation-deposit-panel {
        color: #f8f9fe;
    }

    #invitation-deposit-panel input[type=email],
    #invitation-deposit-panel select {
        min-width: 200px;
    }

    #invitation-deposit-panel--hint {
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 10px 15px;
        border-radius: 5px;
        background: #1c345d;
        color: #4d7bca;
    }

    #invitation-deposit-panel--hint > small {
        text-align: center;
    }

    #invitation-deposit-panel--submit {
        position: relative;
    }

    #invitation-deposit-panel--submit > small {
        position: absolute;
        top: calc(100% - 6px);
        left: 50%;
        transform: translateX(-50%);
        color: #27a844;
    }
</style>
