@extends('dashboard.app')

@section('content')
    <div class="container-fluid py-3">
        <h1 class="mb-3 text-center">@lang('ticket.form.title')</h1>
        <form id="ticket_form" action="{{route('home.ticket.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="input-theme">@lang('ticket.form.theme')</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="theme" id="input-theme" maxlength="255" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label for="input-theme">@lang('ticket.form.appeal')</label>
                <div class="input-group">
                    <select class="form-control" id="input-appeal_id" name="appeal_id">
                        @foreach($listAppeal as $appeal)
                            <option value="{{$appeal->id}}">{{$appeal->descr}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="input-question">@lang('ticket.form.question')</label>
                <div class="input-group">
                    <textarea class="form-control" id="input-question" name="question" rows="10" maxlength="65535"></textarea>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <button type="submit" form="ticket_form" class="btn btn-primary btn-sm">@lang('ticket.form.submit')</button>
                <a type="button" href="{{route('home.ticket')}}" class="btn btn-sm btn-secondary">@lang('ticket.form.back')</a>
            </div>
        </form>
    </div>
@endsection
