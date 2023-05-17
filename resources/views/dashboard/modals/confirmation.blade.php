
<!-- Confirm Modal begin -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">
                    @if(isset($modal_confirm_title)) {{ $modal_confirm_title }} @else @lang('base.general.confirmation') @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($modal_confirm_text)) {{ $modal_confirm_text }} @else @lang('base.general.is_confirm') @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('base.general.cancel')</button>
                <button type="button" class="btn btn-success btn-modal-confirm">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirm Modal end -->
