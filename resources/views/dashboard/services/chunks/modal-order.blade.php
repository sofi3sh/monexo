<div class="modal fade" id="modal_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="ml-auto mt-2 mr-2 close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="text-center h3">@lang('base.dash.services.modals.order.title')</h3>
                <div id="modal-content" class="modal-body">
                    <div class="mb-2">
                        <strong>@lang('base.dash.services.modals.order.services')</strong>
                    </div>
                    <ul id="services-names"></ul> {{-- Не трогать, не заполнять --}}
                    <form id="modal_order_form" method="POST" action="{{ route('home.services.booking') }}">
                        @csrf
                        <div id="hidden-inputs"></div> {{-- Не трогать, не заполнять --}}
                        <label class="d-block">
                            <span>@lang('base.dash.services.modals.order.telegram')</span>
                            <input class="form-control" type="text" name="contact">
                            <input type="hidden" name="services_category_id" value="{{$servicesCategoryId}}">
                        </label>
                        <div class="mb-2"><strong>@lang('base.dash.services.price') </strong><span id="total">$1000</span></div>
                        <button disabled id="form_submit" class="btn btn-primary px-5" type="submit">Оплатить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
