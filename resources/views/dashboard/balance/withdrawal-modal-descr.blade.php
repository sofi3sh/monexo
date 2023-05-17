{{-- Модальное окно вывода описания для методов платежа --}}
<div class="modal fade" id="modalDescPayments" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('base.dash.payments_methods.modal-title-prev') <span>Payeer</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-content" class="modal-body">
                @lang('base.dash.payments_methods.tether')
            </div>
        </div>
    </div>
</div>
{{-- Модальное окно описания для методов платежа USDT --}}
<div class="modal fade" id="modalDescPaymentsUSDT" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('base.dash.payments_methods.modal-title-prev') <span>USDT</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-content" class="modal-body">
                @lang('base.dash.payments_methods.tether')
            </div>
        </div>
    </div>
</div>
