@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <div class="admin-content-block admin-content-block--no-table-radius">
                    <h3>Заказы на услуги</h3>

                    @include('includes.partials.messages')

                    <table class="table" id="table">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Номер заказа</th>
                            <th class="text-center">Пользователь: Имя</th>
                            <th class="text-center">Пользователь: Почта</th>
                            <th class="text-center">Пользователь: ID</th>
                            <th class="text-center">Контакт</th>
                            <th class="text-center">Услуга</th>
                            <th class="text-center">Цена</th>
                            <th class="text-center">Дата создания</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($listBookingDetail as $bookingDetail)
                                <tr>
                                    <td>{{$bookingDetail->id}}</td>
                                    <td>{{$bookingDetail->booking_id}}</td>
                                    <td>{{$bookingDetail->booking->user->name}}</td>
                                    <td>{{$bookingDetail->booking->user->email}}</td>
                                    <td>{{$bookingDetail->booking->user->id}}</td>
                                    <td>{{$bookingDetail->booking->contact}}</td>
                                    <td>{{$bookingDetail->services->name_ru}}</td>
                                    <td>${{$bookingDetail->amount_usd}}</td>
                                    <td>{{$bookingDetail->created_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
