@if($quantityReferrals > 0)
    <div class="card bg-default shadow">
        <div class="card-header bg-transparent border-0">
            <h3 class="text-white mb-0">
                @lang('base.dash.partners.stats.chart.title')
            </h3>
            <form id="chart-form" class="form-inline float-right">

                <div class="input-group input-group-inline input-group-sm mb-2 mr-sm-2">
                    <select class="form-control" style="font-size: 13px !important" name="type">
                        <option value="partners" selected>
                            @lang('base.dash.partners.stats.chart.filter.partners')
                        </option>
                        <option value="cities">
                            @lang('base.dash.partners.stats.chart.filter.cities')
                        </option>
                    </select>
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="font-size: 12px !important">@lang('base.dash.partners.stats.from')</div>
                    </div>
                    <input type="text" style="font-size: 13px !important" name="start" placeholder="@lang('base.dash.partners.stats.date_from')" required value="2019-01-01"  id="datepicker-ref-from" class="form-control">
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="font-size: 12px !important">@lang('base.dash.partners.stats.to')</div>
                    </div>
                    <input name="end" style="font-size: 13px !important" placeholder="@lang('base.dash.partners.stats.date_to')" required value="{{ \Carbon\Carbon::now()->toDateString() }}" type="text" id="datepicker-ref-to" class="form-control">
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="font-size: 12px !important">@lang('base.dash.partners.stats.depth')</div>
                    </div>
                    <select name="level" class="form-control" style="font-size: 12px !important">
                        @for($line = 1; $line <= $maxDepth; $line++)
                        <option {{ 1 == $line ? 'selected' : '' }} value="{{ $line }}">
                            @lang('base.dash.partners.stats.to_line', ['line' => $line])
                        </option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="btn btn-success btn-sm mb-2" style="font-size: 12px">@lang('base.dash.partners.stats.filter')</button>
            </form>
        </div>
        <div id="chart-container" class="backgroud-default" style="min-height: 400px"> 
            <canvas id="chart"></canvas>
        </div>
    </div>

    <script src="{{asset('script/vendor/chart.js/dist/Chart.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

    @if(Auth::user()->locale === 'ru')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ru.min.js" integrity="sha512-+yvkALwyeQtsLyR3mImw8ie79H9GcXkknm/babRovVSTe04osQxiohc1ukHkBCIKQ9y97TAf2+17MxkIimZOdw==" crossorigin="anonymous"></script>
        @else
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/en-gb.min.js" integrity="sha512-w+tDY4gx49+DNVlN7Nmc9ldOkh6nP3w4txBTEatSx3XrZdfYtX9+oylJjQ7RqeeDzDebG3u1VAg/gM5Td2Bd5Q==" crossorigin="anonymous"></script>
    @endif


    <script>
        $(function() {
            let $form = $('#chart-form');
            let userId = "{{Auth::user()->id}}";
            let myChart;
            let type = 'partners';
            let chartContainer = $('#chart-container');

            $form.on('submit', e => {
                e.preventDefault();
                let start = $form.find('[name="start"]').val(),
                    end   = $form.find('[name="end"]').val(),
                    level = $form.find('[name="level"]').val();

                type  = $form.find('[name="type"]').val();

                myChart.destroy();

                $(chartContainer).css({
                    maxWidth: '100%'
                });

                renderChart({
                    start,
                    end,
                    level,
                    type
                });
            });

            renderChart({
                start: new Date(2019, 1, 1).toDateString(),
                end: new Date().toDateString(),
                level: 1,
                type
            });

            function renderChart(props) {
                let {start, end, id, level, type} = props;

                let urlTypes = {
                    'cities': 'cities',
                    'partners': 'partners'
                };

                let url = '/home/referral/statistics/' + urlTypes[type] + '/user/' + userId + '/level/' + level; 

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    url,
                    data: {
                        start,
                        end
                    },
                    success: function(data) {
                        render(data);
                    }
                });

                function render(data) {

                    if(type === 'partners') {

                        const ctx = document.getElementById("chart").getContext("2d");

                        myChart = new Chart(ctx, {
                            type: 'line',
                            options: {
                                scales: {
                                    xAxes: [{
                                        type: 'time',
                                    }]
                                }
                            },
                            data: {
                                labels: data.map(el => el.t), 
                                datasets: [{
                                label: trans('base.dash.partners.stats.chart.partnersCount'),
                                data,
                                backgroundColor: 'rgba(40,167,69, 0.3)',
                                borderColor: [
                                    'rgba(40,167,69, 0.9)',
                                ],
                                borderWidth: 1
                                }]
                            }
                        });

                    } else if(type === 'cities') {
                        const length = data.length; 
                        const densityCanvas = document.getElementById("chart");
                        
                        if(length > 2)
                        {
                            width = length * 220;
                        } else {
                            width = 660;
                        }

                        densityCanvas.closest('div').style.maxWidth = width + 'px';

                        const densityData = {
                            label: trans('base.dash.partners.stats.chart.partnersCount'),
                            data: Array.from(data).map(city => city.city_count),
                            backgroundColor: 'rgba(40,167,69, 0.8)',
                        };

                        myChart = new Chart(densityCanvas, {
                            type: 'bar',
                            data: {
                                labels: Array.from(data).map(city => city.name),
                                datasets: [densityData]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                }
            }
        });
    </script>
@endif
