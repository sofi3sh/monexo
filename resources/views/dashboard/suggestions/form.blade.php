@extends('dashboard.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/suggestions.css')}}">
    <!-- Header -->
    <div class="header bg-primary">
        <div class="container-fluid pb-3">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('base.dash.ideas.new_idea')</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('home.suggestions.index')}}" class="btn btn-sm btn-neutral">@lang('base.general.back')</a>
                    </div>
                </div>
            </div>

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <form action="{{ route('home.suggestions.store') }}" method="POST">
                {{method_field('POST')}}
                @csrf

                <div class="mb-3">
                    <label for="suggestionTitle" class="form-label text-white">@lang('base.dash.ideas.title') (@lang('base.general.optional'))</label>
                    <input type="text" name="title" class="form-control" id="suggestionTitle">
                </div>

                <div class="mb-3">
                    <label for="suggestionType" class="form-label text-white">@lang('base.general.type') (@lang('base.general.optional'))</label>
                    <select type="text" name="type_id" class="form-control" id="suggestionType">
                        <option selected value="">@lang('base.general.no_type')</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="suggestionText" class="form-label text-white">@lang('base.dash.ideas.describe')</label>
                    <textarea class="form-control" name="text" id="suggestionText" rows="10" required></textarea>
                </div>

                <button type="button" id="saveSuggestionBtn" class="btn btn-neutral d-block">@lang('base.general.save')</button>
            </form>
        </div>
    </div>
    @include('dashboard.modals.confirmation', ['modal_confirm_text' => __('base.dash.ideas.confirmation_text')])
@endsection

@section('js')
    @include('dashboard.suggestions.scripts')
@endsection
