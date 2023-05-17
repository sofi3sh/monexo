@if ($showModalInfo)

    <div id="modal-debts" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-center">@lang('debts-info.page-title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @include('dashboard.debts-info')        
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">@lang('buttons.understand')</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            $('#modal-debts').modal('show')
        })
    </script>

@endif