<div id="ticket-instruction" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('ticket.instruction.title')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! nl2br(trans('ticket.instruction.content')) !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">
            @lang('buttons.understand')
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              @lang('buttons.close')
          </button>
        </div>
      </div>
    </div>
</div>
