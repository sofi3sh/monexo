@if($user->bonus_level >= $partnersMapInfo->level && $partnersMapShow == null)
    <div class="card bg-default shadow">
        <div class="card-body text-white">
            <h3 class="text-white mb-0">
                {{$partnersMapInfo->title}}
            </h3>
            <div class="text-white text-sm mb-3">
                {{$partnersMapInfo->content}}
            </div>
            <form action="{{route('home.partners-map-buy.create-app')}}" method="POST" id="buy-partners-map">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="telegram">Telegram:</label>
                    <input type="text" class="form-control" name="telegram" id="telegram" placeholder="Telegram">
                </div>
                <div class="form-group">
                    <label for="city">@lang('base.dash.partners.buy-partners-map.city'):</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="@lang('base.dash.partners.buy-partners-map.city')">
                </div>
                @if($partnersMapInfo->price > 0)
                    <p>@lang('base.dash.partners.modals.partners-map-confirm.price', ['price' => $partnersMapInfo->price])</p>
                @endif
                <button data-toggle="modal" data-target="#buy-partners-map-modal" type="button" class="btn btn-success">@lang('base.dash.partners.buy-partners-map.submit')</button>
            </form>
        </div>
    </div>
@endif

@include('bootstrap-modals.modal-confirm', [
    'dataSubmit' => 'buy-partners-map', 
    'id' => 'buy-partners-map-modal',
    'content' => $partnersMapInfo->price > 0 ? (
    __('base.dash.partners.modals.partners-map-confirm.content') .  
    '<br/>' . 
    __('base.dash.partners.modals.partners-map-confirm.price', ['price' => $partnersMapInfo->price])) :
    __('base.dash.partners.modals.partners-map-confirm.content-free')
])


