@if(Session::has('transferSuccess'))
    <div id="userToUserModalSuccess" class="modal fade" tabindex="-1" data-modal-show role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @lang('base.dash.balance.custom_translations.modals.success.title')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Session::get('transferSuccess')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('base.dash.balance.custom_translations.btns.close')</button>
                </div>
            </div>
        </div>
    </div>
@endif

<div id="userToUserModalConfirm" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @lang('base.dash.balance.custom_translations.modals.confirm.title')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>@lang('base.dash.balance.custom_translations.modals.confirm.commission') </b>{{$userToUserCommission}}%</p>
                <p><b>@lang('base.dash.balance.custom_translations.modals.confirm.sum') </b><span id="userToUserFinalSum"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onClick="submitCustomTransactionForm()">@lang('base.dash.balance.custom_translations.btns.transfer')</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('base.dash.balance.custom_translations.btns.close')</button>
            </div>
        </div>
    </div>
</div>

<script defer>
    function submitCustomTransactionForm() {
        const form = document.querySelector('#customTransactionForm');
        form.submit();
    }
</script>
