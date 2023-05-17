<div id="modalCorrespondent" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-theme"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="modal__label-title" id="modal-appeal-descr"></h3>
                <input type="hidden" id="ticket_id">

                <div>
                   <b>@lang('ticket.correspondence.created_at')</b>
                   <span id="created_at"></span>
                </div>

                <div>
                    <b>@lang('ticket.correspondence.author_name'): </b>
                    <span id="author_name"></span>
                </div>
                <div>
                    <b>@lang('ticket.correspondence.author_email'): </b>
                    <span id="author_email"></span>
                </div>
                <div>
                    <b>@lang('ticket.correspondence.author_phone'): </b>
                    <span id="author_phone"></span>
                </div>
                <div>
                    <b>@lang('ticket.correspondence.question')</b>
                    <span id="question"></span>
                </div>

                <div>
                    <b>@lang('ticket.correspondence.answer'):</b>
                    <div class="container-answer"></div>
                </div>

                <div>
                    <div class="form-group mb-0">
                        <label for="">Отправить сообщение:</label>
                        <textarea class="form-control" id="text_answer" rows="3"></textarea>
                    </div>
                    <div class="container-template"></div>
                </div>

                <button class="btn btn-primary" id="button_answer">Отправить</button>

                <button type="button" class="btn btn-link" id="button-attachment" data-dismiss="modal">
                    @lang('ticket.correspondence.view-attachment')
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    @lang('ticket.correspondence.button-close')
                </button>
            </div>
        </div>
    </div>
</div>
