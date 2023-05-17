<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">@lang('base.dash.balance.exchange.title')</h3>
            </div>
        </div>
    </div>
    <div class="card-body border-0">
        <div class="row">
            <div class="col-3">
                <label for="select-offer_balance_from">@lang('base.dash.balance.exchange.balance_from')</label>
                <select id="select-offer_balance_from" name="offer_balance_from" class="form-control" required>
                    <option value="USD">USD</option>
                    <option value="BTC">BTC</option>
                    <option value="ETH">ETH</option>
                    <option value="PZM" selected>PZM</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <label for="select-offer_balance_to">@lang('base.dash.balance.exchange.balance_to')</label>
                <select id="select-offer_balance_to" name="offer_balance_to" class="form-control" required>
                    <option value="USD" selected>USD</option>
                    <option value="BTC">BTC</option>
                    <option value="ETH">ETH</option>
                    <option value="PZM">PZM</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <label for="input-offer_amount_from">@lang('base.dash.balance.exchange.amount_from')</label>
                <input
                    required
                    type="number"
                    name="offer_amount_from"
                    id="input-offer_amount_from"
                    min="0"
                    step="0.0001"
                    class="form-control">
            </div>
        </div>
        <p></p>
        <div class="row">
            <div class="col-3">
                <button id="button-exchange" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_exchange">
                    @lang('base.dash.balance.exchange.run')
                </button>
            </div>
        </div>
    </div>
</div>
