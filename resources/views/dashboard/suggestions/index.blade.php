@extends('dashboard.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/suggestions.css')}}">
    <!-- Header -->
    <div class="header bg-primary">
        <div class="container-fluid pb-3">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0 mr-4">@lang('base.dash.menu.ideas')</h6>
                        <div class="form-group d-inline-block mb-0">
                            <select class="form-control select-neutral" id="suggestionTypeFilter">
                                <option value="">@lang('base.general.all_types')</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ (!is_null(request('type_id')) and request('type_id') == $type->id) ? 'selected=selected' : '' }}
                                    >{{ $type->title }}</option>
                                @endforeach
                                <option value="0"
                                    {{ (!is_null(request('type_id')) and request('type_id') == '0') ? 'selected=selected' : '' }}
                                >@lang('base.general.without_type')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        @if (auth()->user()->bonus_level > 0)
                            <a href="{{route('home.suggestions.create')}}" class="btn btn-sm btn-neutral">@lang('base.general.create')</a>
                        @else
                            <button class="btn btn-sm btn-light">@lang('base.general.create')</button>
                        @endif
                    </div>
                </div>
            </div>

            @isset($suggestions)
                @foreach($suggestions as $suggestion)
                    <div class="suggestion-item mb-3" data-id="{{$suggestion->id}}">
                        <div class="suggestion-card">

                            <div class="suggestion-type">
                                @if(is_null(request('type_id')) and $suggestion->type)
                                    <span class="badge badge-primary border border-primary align-bottom">{{ $suggestion->type->title }}</span>
                                @endif
                            </div>

                            <div class="suggestion-title">
                            @if($suggestion->title)
                                <b class="mr-2">{{ $suggestion->title }}</b>
                            @endif
                            </div>

                            <div class="suggestion-text text-break">{{ $suggestion->text }}</div>

                            <div class="round dislike-suggestion @if(count($suggestion->likes) and !$suggestion->likes[0]->is_positive) liked @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                                    <path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.378 1.378 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51.136.02.285.037.443.051.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.896 1.896 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2.094 2.094 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.162 3.162 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.823 4.823 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591z"/>
                                </svg>
                                <span class="likes-count">{{ $suggestion->dislikes_count }}</span>
                            </div>

                            <div class="round like-suggestion @if(count($suggestion->likes) and $suggestion->likes[0]->is_positive) liked @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                    <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.964.22.817.533 2.512.062 4.51a9.84 9.84 0 0 1 .443-.05c.713-.065 1.669-.072 2.516.21.518.173.994.68 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.162 3.162 0 0 1-.488.9c.054.153.076.313.076.465 0 .306-.089.626-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.826 4.826 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.616.849-.231 1.574-.786 2.132-1.41.56-.626.914-1.279 1.039-1.638.199-.575.356-1.54.428-2.59z"/>
                                </svg>
                                <span class="likes-count">{{ $suggestion->likes_count }}</span>
                            </div>
                        </div>

                    </div>
                @endforeach

                    <div class="d-flex justify-content-center">
                        {{ $suggestions->onEachSide(5)->appends(request()->except('page'))->links() }}
                    </div>
            @endisset
        </div>
    </div>
@endsection
@section('js')
    @include('dashboard.suggestions.scripts')
@endsection
