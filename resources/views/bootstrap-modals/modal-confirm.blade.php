<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@lang('base.dash.partners.modals.partners-map-confirm.title')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! $content !!}
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="button" data-submit="{{$dataSubmit}}">@lang('base.dash.partners.modals.partners-map-confirm.submit')</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">@lang('base.dash.partners.modals.partners-map-confirm.cancel')</button>
        </div>
      </div>
    </div>
</div>

    