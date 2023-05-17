@extends('dashboard.app')

@section('js')
    <script src="{{ asset('js/ticket/listMyTicket.js') }}" defer></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="admin-content-block">
            <h3 class="mb-3">@lang('ticket.name')</h3>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="ticket-my-tab" data-toggle="pill" href="#ticket-my" role="tab" aria-controls="ticket-my" aria-selected="true">@lang('ticket.tab-ticket-my')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="ticket-partner-tab" data-toggle="pill" href="#ticket-partner" role="tab" aria-controls="ticket-partner" aria-selected="false">@lang('ticket.tab-ticket-partners')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="ticket-template-tab" data-toggle="pill" href="#ticket-template" role="tab" aria-controls="ticket-template" aria-selected="false">@lang('ticket.tab-ticket-template')</a>
                </li>

                <li class="nav-item">
                    <button class="btn nav-link" id="ticket-template-tab" data-toggle="modal" data-target="#ticket-instruction" >@lang('ticket.instruction.btn')</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="ticket-my" role="tabpanel" aria-labelledby="ticket-my-tab">
                    <a class="btn btn-primary btn-sm mb-4" href="{{ route('home.ticket.create') }}">Создать тикет</a>
                    <div class="table-responsive">
                        <table id="ticket-table" class="table without-datatable">
                            <thead>
                                <tr>
                                    <th>@lang('ticket.tab-my.id')</th>
                                    <th>@lang('ticket.tab-my.theme')</th>
                                    <th>@lang('ticket.tab-my.text')</th>
                                    <th>@lang('ticket.tab-my.attachment')</th>
                                    <th>@lang('ticket.tab-my.unread')</th>
                                    <th>@lang('ticket.tab-my.created')</th>
                                    <th>@lang('ticket.tab-my.date-time')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($listTicketMy)
                                    @foreach($listTicketMy as $ticketMy)
                                        <tr class="row-ticket-my" style="cursor: pointer">
                                            <td>{{$ticketMy->id ?? ''}}</td>
                                            <td>{{$ticketMy->theme ?? ''}}</td>
                                            <td>{{$ticketMy->question_short ?? ''}}</td>
                                            <td>{{''}}</td>
                                            <td><span id="not-viewed">{{$ticketMy->not_viewed}}</span></td>
                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticketMy->created_at)->diffForHumans()}}</td>
                                            <td>{{$ticketMy->created_at ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="ticket-partner" role="tabpanel" aria-labelledby="ticket-partner-tab">
                    <div class="table-responsive">
                        <table id="blog-categories-table" class="table without-datatable">
                            <thead>
                                <tr>
                                    <th>@lang('ticket.tab-partners.id')</th>
                                    <th>@lang('ticket.tab-partners.type-ticket')</th>
                                    <th>@lang('ticket.tab-partners.theme')</th>
                                    <th>@lang('ticket.tab-partners.text')</th>
                                    <th>@lang('ticket.tab-partners.attachment')</th>
                                    <th>@lang('ticket.tab-partners.user-name')</th>
                                    <th>@lang('ticket.tab-partners.user-email')</th>
                                    <th>@lang('ticket.tab-partners.user-phone')</th>
                                    <th>@lang('ticket.tab-partners.date-create')</th>
                                    <th>@lang('ticket.tab-partners.status')</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @isset($listTicketPartner)
                                    @foreach($listTicketPartner as $ticketPartner)
                                        <tr class="row-ticket-my" style="cursor: pointer">
                                            <td>{{$ticketPartner->id ?? ''}}</td>
                                            <td>{{$ticketPartner->appeal->descr ?? ''}}</td>
                                            <td>{{$ticketPartner->theme ?? ''}}</td>
                                            <td>{{$ticketPartner->question_short ?? ''}}</td>
                                            <td>{{$ticketPartner->attachment_count ?? ''}}</td>
                                            <td>{{$ticketPartner->user->email ?? ''}}</td>
                                            <td>{{$ticketPartner->user->phone ?? ''}}</td>
                                            <td>{{$ticketPartner->created_at ?? ''}}</td>
                                            <td>{{$ticketPartner->ticket_status->descr ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="ticket-template" role="tabpanel" aria-labelledby="ticket-template-tab">
                    <a class="btn btn-primary btn-sm mb-4" href="{{ route('home.ticket.create.template') }}">Создать шаблон</a>
                    <div class="table-responsive">
                        <table id="blog-categories-table" class="table">
                            <thead>
                            <tr>
                                <th>@lang('ticket.tab-template.edit')</th>
                                <th>@lang('ticket.tab-template.id')</th>
                                <th>@lang('ticket.tab-template.template')</th>
                                <th>@lang('ticket.tab-template.created_at')</th>
                                <th>@lang('ticket.tab-template.updated_at')</th>
                                <th>@lang('ticket.tab-template.delete')</th>
                            </tr>
                            </thead>
                            <tbody>
                             @isset($listTicketTemplate)
                                @foreach($listTicketTemplate as $ticketTemplate)
                                    <tr>
                                        <td><a href="{{route('home.ticket.edit.template', $ticketTemplate['id'])}}" class="btn btn-sm">✏️</a></td>
                                        <td>{{$ticketTemplate->id ?? ''}}</td>
                                        <td>{{$ticketTemplate->template ?? ''}}</td>
                                        <td>{{$ticketTemplate->created_at ?? ''}}</td>
                                        <td>{{$ticketTemplate->updated_at ?? ''}}</td>
                                        <td>
                                            <form method="post"
                                                  action="{{ route('home.ticket.destroy.template', $ticketTemplate['id']) }}"
                                                  onsubmit="return confirm('Удалить шаблон ответа?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm">🗑️️</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @include('dashboard.ticket.modal-instruction')

    @include('dashboard.ticket.modal-correspondence')
{{--    @include('dashboard.ticket.modal-attachment')--}}
@endsection
