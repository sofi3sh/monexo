{{-- Модальное окно для подтверждения валютообмена --}}
<div class="modal fade" id="modal_exchange" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Валютообмен</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="error-message" class="form-group row">
                </div>
                <div class="form-group row">
                    Курс без вычета 4% <strong id="rate-original"></strong>
                </div>
                <div class="form-group row">
                    Сумма перевода уменьшиная на 1% <strong id="amount-commission"></strong>
                </div>
                <form  action="{{route('home.balance.exchange')}}" id="form-exchange" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="input-currency_from" class="col-sm-2 col-form-label">С баланса:</label>
                        <div class="col-sm-10">
                            <input type="text" name="currency_from" id="input-currency_from" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-amount_from" class="col-sm-2 col-form-label">Будет списано:</label>
                        <div class="col-sm-5">
                            <input type="number" name="amount_from" id="input-amount_from" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="currency_to" id="input-currency_to" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-rate" class="col-sm-2 col-form-label">По курсу:</label>
                        <div class="col-sm-10">
                            <input type="number" name="rate" id="input-rate" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row">
                        С учетом комиссии 1%
                    </div>
                    <div class="form-group row">
                        <label for="input-amount_to" class="col-sm-2 col-form-label">Будет зачислено:</label>
                        <div class="col-sm-10">
                            <input type="number" name="amount_to" id="input-amount_to" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                            <input type="submit" form="form-exchange" id="button-exchange-confirm" class="btn btn-primary" value="Я согласен с условиями обмена">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">Отказаться</span>
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
