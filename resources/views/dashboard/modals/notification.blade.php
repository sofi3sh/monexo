
<!-- Notify Modal begin -->
<div class="modal fade" id="notifyModal" tabindex="-1" aria-labelledby="confirmNotifyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmNotifyLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="notification-text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="telegram-instruction" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @lang('base.dash.profile.tg-instruction.title')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @lang('base.dash.profile.tg-instruction.content')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    @lang('buttons.understand')
                </button>
            </div>
        </div>
    </div>
</div>




<script>
    function openNotificationModal (title, message) {
        const $_modal = $('#notifyModal');
        const $_title = $_modal.find('.modal-title');
        const $_message = $_modal.find('.notification-text');

        $_title.text(title);
        $_message.text(message);

        $_modal.modal()

        $_modal.on('hidden.bs.modal', function (event) {
            $_title.text('');
            $_message.text('');

            $_modal.off('hidden.bs.modal');
        })
    }
</script>
<!-- Notify Modal end -->
