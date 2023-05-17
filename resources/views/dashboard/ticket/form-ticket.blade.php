@extends('dashboard.app')

@section('content')
    <div class="container-fluid py-3">
        <h1 class="mb-3 text-center">@lang('ticket.form-template.title')</h1>
        <form id="ticket_form_template" action="{{route('home.ticket.store.template')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="input-theme">@lang('ticket.form-template.id')</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="id" id="input-id" value="{{$responseTemplate['id'] ?? ''}}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="input-question">@lang('ticket.form-template.template')</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="template" id="input-template" value="{{$responseTemplate->template ?? ''}}" maxlength="8192">
                </div>
            </div>
            <div class="d-flex align-items-center">
                <button type="submit" form="ticket_form_template" class="btn btn-primary btn-sm">@lang('ticket.form-template.submit')</button>
                <a href="{{route('home.ticket')}}" class="btn btn-sm btn-secondary">
                    @lang('ticket.form-template.back')
                </a>
            </div>
        </form>
    </div>
@endsection
