<section class="events section">
    <div class="container events__container">
        <h1 class="title text-center mb-3">@lang('dinway.pages.events')</h1>
        <div class="table-responsive">
            <table class="table table--blue table--center">
                <thead class="text-nowrap" style="white-space: nowrap;">
                    <tr>
                        <th>@lang('dinway.events.table.event')</th>
                        <th>@lang('dinway.events.table.start')</th>
                        <th>@lang('dinway.events.table.presenter')</th>
                        <th>@lang('dinway.events.table.duration')</th>
                        <th>@lang('dinway.events.table.details')</th>
                        <th>@lang('dinway.events.table.price')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{$event->name}}</td>
                            <td style="white-space: nowrap;">{{date('d.m.Y H:m', strtotime($event->start))}}</td>
                            <td style="white-space: nowrap;">{{$event->presenter}}</td>
                            <td>{{$event->duration}}</td>
                            <td style="text-align: left; line-height: 125%">{!! $event->details !!}</td>
                            <td>
                                @if($event->price == 0)
                                    @lang('dinway.events.table.free')
                                @else
                                    {{$event->price}}
                                @endif
                            </td>
                        </tr>        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


