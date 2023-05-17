@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success')}}</div>
        @endif

        <div class="row">
            <div class="col-12">
                <br>

                <div class="admin-content-block">
                    <h3 class="mb-3">{{ $title }}</h3>

                    <form method="post"
                          action="{{ $action_route }}"
                          enctype="multipart/form-data">
                        @method($action_method)
                        @csrf

                        @foreach($fields as $field)
                            @php(empty($field['type']) && $field['type'] = 'text')

                            @if($field['type'] === 'radio')
                                    <div class="form-check">
                                    <input value="{{$field['value']}}" class="form-check-input" type="radio" name="{{$field['name']}}" id="{{'type' . $loop->index}}">
                                    <label class="form-check-label" for="{{'type' . $loop->index}}">
                                        {{$field['label']}}
                                    </label>
                                  </div>
                            @else

                                <div class="form-group">
                                        <label for="crud-form-field-{{ $field['name'] }}"
                                            class="@error($field['name']) text-danger @enderror">
                                            {{ $field['label'] }}
                                            @isset($field['required'])
                                                <small>- обязательно</small>
                                            @endisset
                                        </label>

                                        @if($field['type'] === 'textarea')
                                            <textarea name="{{ $field['name'] }}"
                                                    class="form-control @error($field['name']) is-invalid @enderror"
                                                    id="crud-form-field-{{ $field['name'] }}"
                                                    placeholder="{{ $field['placeholder'] ?? $field['label'] }}"
                                                    @isset($field['required']) required @endisset
                                                    rows="@isset($field['rows']) {{$field['rows']}} @else 3 @endisset)">{{ old($field['name']) ?: $field['value'] ?? '' }}</textarea>
                                        @elseif($field['type'] === 'select')
                                            <select name="{{ $field['name'] }}@isset($field['multiple'])[]@endisset"
                                                    class="form-control @error($field['name']) is-invalid @enderror"
                                                    id="crud-form-field-{{ $field['name'] }}"
                                                    @isset($field['multiple']) multiple @endisset
                                                    @isset($field['required']) required @endisset>
                                                @foreach($field['options'] as $option)
                                                    <option value="{{ $option['value'] }}"
                                                            @if(old($field['name']) || isset($option['selected'])) selected @endif>{{ $option['label'] }}</option>
                                                @endforeach
                                            </select>

                                            @isset($field['multiple'])
                                                <button type="button"
                                                        class="btn btn-sm"
                                                        onclick="this.previousElementSibling.value = [];">Очистить
                                                </button>
                                            @endisset
                                        @elseif($field['type'] === 'image')
                                            @isset($field['value'])
                                                <div class="mb-2">
                                                    <a target="_blank"
                                                    class="btn btn-sm btn-primary"
                                                    href="{{ $field['value'] }}"
                                                    style="font-size: 12px; padding: 4px 6px;">
                                                        Текущая картинка
                                                    </a>
                                                </div>
                                            @endisset

                                            <input type="file"
                                                name="{{ $field['name'] }}"
                                                value="{{ old($field['name']) ?: $field['value'] ?? '' }}"
                                                class="form-control-file @error($field['name']) is-invalid @enderror"
                                                id="crud-form-field-{{ $field['name'] }}">
                                        @elseif($field['type'] === 'checkbox')
                                            <input name="{{ $field['name'] }}"
                                                class="@error($field['name']) is-invalid @enderror"
                                                type="checkbox"
                                                id="crud-form-field-{{ $field['name'] }}"
                                                value="1"
                                                @if(old($field['name']) || !empty($field['value'])) checked @endisset
                                                @isset($field['required']) required @endisset>
                                        @else
                                            <input type="{{ $field['type'] }}"
                                                name="{{ $field['name'] }}"
                                                class="form-control @error($field['name']) is-invalid @enderror"
                                                id="crud-form-field-{{ $field['name'] }}"
                                                value="{{ old($field['name']) ?: $field['value'] ?? '' }}"
                                                placeholder="{{ $field['placeholder'] ?? $field['label'] }}"
                                                @isset($field['required']) required @endisset
                                                @isset($field['readonly']) readonly @endisset>
                                        @endif

                                        @isset($field['hint'])
                                            <small class="form-text text-muted @error($field['name']) text-danger @enderror">{{ $field['hint'] }}</small>
                                        @endisset
                                </div>
                            @endif
                        @endforeach

                        <div class="form-group mt-3">
                            @if(!empty($route_back))
                                <a href="{{ $route_back }}">
                                    <button type="button" class="btn btn-outline-primary">
                                        Назад
                                    </button>
                                </a>
                            @endif

                            <button type="submit" class="btn btn-primary">
                                {{ $action_name }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
