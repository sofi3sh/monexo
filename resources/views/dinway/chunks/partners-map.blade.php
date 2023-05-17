@if(isset($partnersMap) && ($partnersMap->show || isset($show)))
    @if(isset($lk))
        <style>
            .map-container {
                min-height: 800px
            }
            @media screen and (max-width: 820px) {
                .map-container {
                    min-height: initial
                }
            }
        </style>
        <section class="container-fluid h-100" >
            <div class="d-flex align-items-center py-3 justify-content-center map-container">
                {!! $partnersMap->code !!}
            </div>
        </section>
    @else
        <section class="section">
            <div class="container">
                <div class="aos-init aos-animate" data-aos="zoom-in">
                    {!! $partnersMap->code !!}
                </div>
            </div>
        </section>
    @endif
@endif


{{-- @if($partners->count())
    @php
        $mapData = [];

        foreach ($partners as &$partner) {
            $title = '';
            $title .= __('Name') . ": {$partner->name} {$partner->surname}";
            $title .= "\n" . __('Age') . ': ' . $partner->age;
            $title .= "\n" . __('City') . ': ' . $partner->city;
            $title .= "\n" . __('Phone') . ': ' . $partner->phone;
            $title .= "\nTelegram: " . $partner->telegram;

            $mapData[] = [
                'title' => $title,
                'latitude' => $partner->coordinates['latitude'],
                'longitude' => $partner->coordinates['longitude'],
                'color' => '#1448B6',
            ];

            unset($partner);
        }

        $mapData = json_encode($mapData, JSON_UNESCAPED_UNICODE);
    @endphp

    @if(isset($lk))
        <section class="container-fluid">
            <div class="d-flex align-items-center justify-content-center">
                <div id='partners-map' class="w-100" style="height: 100vh"></div>
            </div>
        </section>
    @else
        <section class="section">
            <div class="container">
                <div class="aos-init aos-animate" data-aos="zoom-in">
                    <div id='partners-map'></div>
                </div>
            </div>
        </section>
    @endif

    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

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

            imageSeries.data = {!! $mapData !!};

        });
    </script>
@endif --}}


