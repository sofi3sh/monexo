@extends('layouts.admin')

@section('content')
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <div class="container-fluid">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
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
                                              rows="3">{{ old($field['name']) ?: $field['value'] ?? '' }}</textarea>
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
                                @elseif($field['type'] === 'map')
                                    <div id='partners-map'></div>

                                    @php($value = old($field['name']) ?: $field['value'] ?? '')

                                    <input id="coordinated-input"
                                           type="text"
                                           readonly
                                           class="form-control @error($field['name']) is-invalid @enderror"
                                           placeholder="{{ $field['placeholder'] ?? $field['label'] }}"
                                           @isset($field['required']) required @endisset
                                           name="{{ $field['name'] }}"
                                           value="{{ $value ? json_encode($value) : '' }}">

                                    <script>
                                        am4core.ready(function () {
                                            am4core.useTheme(am4themes_animated);

                                            const chart = am4core.create('partners-map', am4maps.MapChart);
                                            chart.geodata = am4geodata_worldLow;
                                            chart.projection = new am4maps.projections.Miller();

                                            const polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
                                            polygonSeries.exclude = ['AQ'];
                                            polygonSeries.useGeodata = true;

                                            const polygonTemplate = polygonSeries.mapPolygons.template;
                                            polygonTemplate.tooltipText = '{name}';
                                            polygonTemplate.polygon.fillOpacity = 0.6;

                                            const hs = polygonTemplate.states.create('hover');
                                            hs.properties.fill = chart.colors.getIndex(0);

                                            const imageSeries = chart.series.push(new am4maps.MapImageSeries());
                                            imageSeries.mapImages.template.propertyFields.longitude = 'longitude';
                                            imageSeries.mapImages.template.propertyFields.latitude = 'latitude';
                                            imageSeries.mapImages.template.tooltipText = '{title}';
                                            imageSeries.mapImages.template.propertyFields.url = 'url';

                                            const circle = imageSeries.mapImages.template.createChild(am4core.Circle);
                                            circle.radius = 3;
                                            circle.propertyFields.fill = 'color';

                                            const circle2 = imageSeries.mapImages.template.createChild(am4core.Circle);
                                            circle2.radius = 3;
                                            circle2.propertyFields.fill = 'color';
                                            circle2.events.on('inited', function (event) {
                                                animateBullet(event.target);
                                            });

                                            function animateBullet(circle) {
                                                circle.animate([
                                                    {property: 'scale', from: 1, to: 3.5},
                                                    {property: 'opacity', from: 1, to: 0.35}
                                                ], 1000, am4core.ease.circleOut);
                                            }

                                            @if(old($field['name']) || !empty($field['value']))
                                                imageSeries.data = [
                                                {
                                                    title: 'Координаты партнера',
                                                    latitude: {{ $value['latitude'] }},
                                                    longitude: {{ $value['longitude'] }},
                                                    color: '#c39205'
                                                }
                                            ];
                                            @endif

                                            chart.seriesContainer.events.on('hit', function (ev) {

                                                var coords = chart.svgPointToGeo(ev.svgPoint);
                                                var marker = imageSeries.mapImages.create();
                                                marker.latitude = coords.latitude;
                                                marker.longitude = coords.longitude;

                                                document.querySelector('#coordinated-input').value = JSON.stringify(coords);
                                            });
                                        });
                                    </script>
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
                        @endforeach

                        <div class="form-group">
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
