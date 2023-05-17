<div class="modal micromodal-slide @yield('className')" id="modal-info" aria-hidden="true"> {{-- data-micromodal-show --}} 
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal__close" aria-label="@lang('dinway.modal-linear-program.close')" data-micromodal-close>X</button>
            <div class="modal__header">
                @section('header')
                    <h5 id="title"></h5>
                @show
            </div>    
            <div id="content" class="modal__body mb-3"></div>
            <div class="modal__footer">
                @section('footer')
                    <button class="btn-transparent" data-micromodal-close>@lang('dinway.btns.close')</button>
                @show
            </div>
        </div>
    </div>
</div>

