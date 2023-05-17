<div class="card bg-default shadow">
    <div class="card-header bg-transparent border-0">
        <h3 class="text-white mb-0">
            @lang('base.dash.partners.stats.title')
            <form action="" method="get" class="form-inline float-right">
                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@lang('base.dash.partners.stats.from')</div>
                    </div>
                    <input name="filter[from]" placeholder="@lang('base.dash.partners.stats.date_from')" required style="height: 3.1em;" value="{{ request('filter.from') }}" type="text" id="datepicker-ref-from" class="form-control">
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@lang('base.dash.partners.stats.to')</div>
                    </div>
                    <input name="filter[to]" placeholder="@lang('base.dash.partners.stats.date_to')" required style="height: 3.1em;" value="{{ request('filter.to') }}" type="text" id="datepicker-ref-to" class="form-control">
                </div>

                <div class="input-group input-group-sm mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@lang('base.dash.partners.stats.depth')</div>
                    </div>
                    <select name="filter[depth]" class="form-control" style="height: 3.1em;">
                        @for($line = 1; $line <= $maxDepth; $line++)
                        <option {{ request('filter.depth', $maxDepth) == $line ? 'selected' : '' }} value="{{ $line }}">
                            @lang('base.dash.partners.stats.to_line', ['line' => $line])
                        </option>
                        @endfor
                    </select>
                </div>

                <button type="submit" name="stats" value="1" class="btn btn-success mb-2">@lang('base.dash.partners.stats.filter')</button>
            </form>
        </h3>
    </div>
    <div class="table-responsive">
        <table class="table-tree table align-items-center table-dark table-flush">
            <thead class="thead-dark">
            <tr>
                <th scope="col">@lang('base.dash.partners.stats.name')</th>
                <th scope="col">@lang('base.dash.partners.stats.value')</th>
            </tr>
            </thead>
            <tbody class="list">
            @if ($stats):
                <tr>
                    <td>@lang('base.dash.partners.stats.total_count'):</td>
                    <td>{{ $stats['plans_count'] }}</td>
                </tr>
                <tr>
                    <td>@lang('base.dash.partners.stats.total_sum_invest'):</td>
                    <td>${{ $stats['plans_sum_usd'] }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="2">@lang('base.dash.partners.stats.empty')</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

<div class="card bg-default shadow">
    <div class="card-header bg-transparent border-0">
        <h3 class="text-white mb-0">@lang('base.dash.menu.partners')</h3>
    </div>
    <div class="table-responsive">
        <table class="table-tree table align-items-center table-dark table-flush">
            <thead class="thead-dark">
            <tr>
                <th scope="col">@lang('base.dash.partners.table.email')</th>
                <th scope="col">@lang('base.dash.partners.table.level')</th>
                <th scope="col">@lang('base.dash.partners.table.datereg')</th>
                <th scope="col">@lang('base.dash.partners.table.profit')</th>
                <th scope="col">@lang('base.dash.partners.table.deposits')</th>
            </tr>
            </thead>
            <tbody class="list">
            @if (count($refferralsRecursive))
                @php $i=1 @endphp
                @foreach ($refferralsRecursive as $item)
                    @include ('dashboard.recursive', ['children' => $item, 'key' => $i])
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ru.min.js" integrity="sha512-tPXUMumrKam4J6sFLWF/06wvl+Qyn27gMfmynldU730ZwqYkhT2dFUmttn2PuVoVRgzvzDicZ/KgOhWD+KAYQQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    <script>
        $(function() {
            $('#datepicker-ref-from').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                language: 'ru'
            });

            $('#datepicker-ref-to').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                language: 'ru'
            });
        });
    </script>
@endsection
