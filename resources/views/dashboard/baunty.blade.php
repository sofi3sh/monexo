@extends('dashboard.app')

@section('content')
<div class="title">
    @lang('base.dash.bounty.title')
</div>
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
@if(session('flash_succes'))
    <p>{{session('flash_succes')}}</p>
@endif
</div>
        <div class="baunty-items">
            <div class="baunty-item">
                <div class="baunty-title">
                    <img src="{{asset('images/lk/b1.svg')}}" alt="">
                    @lang('website_services.bounty.items.1.title') / @lang('website_services.bounty.items.1.bonus')
                </div>
                <div class="baunty-content">
                    @lang('website_services.bounty.items.1.content')
                    <form method="POST" action="{{route('home.baunty.save.link')}}">
                        @csrf
                        <input type="text" class="form-control" placeholder="@lang('website_services.bounty.save')" name="link">
                        <input type="hidden" name="package_id" value="1">
                        <button type="submit">@lang('website_services.bounty.send')</button>
                    </form>
                </div>
            </div>
            <div class="baunty-item">
                <div class="baunty-title">
                    <img src="{{asset('images/lk/b1.svg')}}" alt="">
                    @lang('website_services.bounty.items.2.title') / @lang('website_services.bounty.items.2.bonus')
                </div>
                <div class="baunty-content">
                    @lang('website_services.bounty.items.2.content')
                    <form method="POST" action="{{route('home.baunty.save.link')}}">
                        @csrf
                        <input type="text" class="form-control" placeholder="@lang('website_services.bounty.save')" name="link">
                        <input type="hidden" name="package_id" value="2">
                        <button type="submit">@lang('website_services.bounty.send')</button>
                    </form>
                </div>
            </div>
            <div class="baunty-item">
                <div class="baunty-title">
                    <img src="{{asset('images/lk/b2.svg')}}" alt="">
                    @lang('website_services.bounty.items.3.title') / @lang('website_services.bounty.items.3.bonus')
                </div>
                <div class="baunty-content">
                    @lang('website_services.bounty.items.3.content')
                    <form method="POST" action="{{route('home.baunty.save.link')}}">
                        @csrf
                        <input type="text" class="form-control" placeholder="@lang('website_services.bounty.save')" name="link">
                        <input type="hidden" name="package_id" value="3">
                        <button type="submit">@lang('website_services.bounty.send')</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="baunty-warning">
            @lang('base.dash.bounty.bounty-warning')        
        </div>
        <div class="block">
            <div class="title">
                @lang('base.dash.baunty.history.title')
            </div>
            <div class="operation-container">
            <div class="operation-table__container">
                <div class="operation-table">
                    <div class="operation-thead">
                        <div class="operation-tr">
                            <div class="operation-th" style="flex-basis: 25%;">@lang('base.dash.baunty.history.date')</div>
                            <div class="operation-th" style="flex-basis: 25%;">@lang('base.dash.baunty.history.package')</div>
                            <div class="operation-th" style="flex-basis: 25%;">@lang('base.dash.baunty.history.link')</div>
                            <div class="operation-th" style="flex-basis: 25%;display: block;text-align: center;">@lang('base.dash.baunty.history.status')</div>
                        </div>
                    </div>
                    @if(!is_null($links))
                        @foreach($links as $item)
                        <div class="operation-tr">
                            <div class="operation-td" style="flex-basis: 25%;">
                                {{$item->created_at}}
                            </div>
                            <div class="operation-td" style="flex-basis: 25%;">
                                {{$item->package->name}}
                            </div>
                            <div class="operation-td" style="flex-basis: 25%;">
                                <a href="{{ $item->link }}" title="{{$item->link}}" target="_blank">{{ substr($item->link, 0, 30) }}{{(strlen($item->link) > 30) ? '...' : ''}}</a>
                            </div>                      
                            <div class="operation-td {{($item->status =='notexecuted' || $item->status=='canceled')?'operation-td__rejected': 'operation-td__performed'}}" style="flex-basis: 25%; text-align: center;display: block;">
                                @if($item->status=='notexecuted')
                                    @lang('base.dash.baunty.history.status_waiting')
                                @elseif($item->status=='canceled')
                                    @lang('base.dash.baunty.history.status_canceled')
                                @else
                                    @lang('base.dash.baunty.history.status_accepted')
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        </div>
@endsection