<div class="modal fade" id="@yield('id')" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@yield('title')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @yield('content')
        </div>
        <div class="modal-footer">
            @yield('footer')
        </div>
      </div>
    </div>
</div>