@extends('auth.layout', ['title' => __('auth.header.registration')])

@section('content')
  <link rel="stylesheet" href="{{asset('css/autocomplete.min.css')}}">

    <style>
      .iti-form-country .iti--allow-dropdown .iti__flag-container, .iti-form-country .iti--separate-dial-code .iti__flag-container {
        right: 0;
      }
      .iti-form-country .iti__dial-code {
        display: none;
      }
      #form-country {
        background-color: #fff;
      }

      .autocomplete > div {
        padding: 3px;
      }

      .autocomplete>div.selected, .autocomplete>div:hover:not(.group) {
          background: rgba(0,0,0,0.1);
          color: var(--dark);
          cursor: pointer;
      }
      .autocomplete > div.selected {
        color: var(--white) !important;
        background-color: var(--blue) !important;
      }

      .autocomplete > div:hover {
        color: var(--white);
        background-color: rgba(0, 0, 0, 0.3)
      }

    </style>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>@lang('auth.add-phone.title')</small>
              </div>
              <form id="form-register" role="form" action="{{ route('register.add-phone') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-3 {{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input id="form-phone" class="form-control" value="{{ old('phone') }}" placeholder="9999999999" type="text">
                    <input type="hidden" value="{{ old('phone') }}" name="phone" id="form-phone-hidden">
                  </div>
                    <span class="invalid-feedback" role="alert">
                        @if ($errors->has('phone'))
                          <strong>{{ $errors->first('phone') }}</strong>
                        @endif
                    </span>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">
                    @lang('base.general.save')
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  @if(count($errors))
      <div class="modal fade" id="errorsModal" tabindex="-1" role="dialog" aria-labelledby="Errors" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">@lang('auth.register.errors')</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      @foreach($errors->default->getMessages() as $array)
                          @foreach($array as $message)
                              <p>{{$message}}</p>
                          @endforeach
                      @endforeach
                  </div>
                  <div class="modal-footer">

                      <div class="modal-footer">
                      <a class="btn btn-primary" role="button" href="{{ route('register.query.email') }}">@lang('auth.btns.query_email')</a>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('auth.btns.close')</button>
                  </div>
              </div>
          </div>
      </div>
  @endif
@endsection

@section('js')
    @parent
    @if(count($errors))
        <script>
            $('#errorsModal').modal('show');
        </script>
    @endif
@endsection
