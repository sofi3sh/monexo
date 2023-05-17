@extends('dashboard.payment')
@section('css')
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<style type="text/css">
	body {
		background-image: url({{asset('images/back.jpg')}});
	}
	.container {
		width: 90%;
		height: 300px;
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
	}
	.btn-green {
		display: block;
		margin: 10px auto;
		color: #fff;
	    background-color: #218838;
	    border-color: #1e7e34;
	}
	.btn-green:hover {
		color: white;
		opacity: 0.8;
	}
</style>
@stop
@section('content')
<div class="container">
	<h2 style="color: black;">@lang('payment.pm.question')<?=$summ ?><?=$currency ?>@lang('payment.pm.through')</h2>
	<form action="https://perfectmoney.is/api/step1.asp" method="POST">
		@csrf
	    <input type="hidden" name="PAYEE_ACCOUNT" value="U20698738">
	    <input type="hidden" name="PAYEE_NAME" value="graybet.pro">
	    <input type="hidden" name="PAYMENT_AMOUNT" value="{{$summ}}">
	    <input type="hidden" name="PAYMENT_UNITS" value="{{$currency}}">
	    <input type="hidden" name="STATUS_URL" value="https://dinway.ai/payment/pm_ipn">
	    <input type="hidden" name="PAYMENT_URL" value="https://dinway.ai/payment/pm_success">
	    <input type="hidden" name="NOPAYMENT_URL" value="https://dinway.ai/payment/pm_fail">
	    <input type="hidden" name="PAYMENT_ID" value="{{$order}}">
		<input type="submit" class="btn btn-green btn-balans" value="@lang('payment.pm.confirm')">
	</form>
</div>
@endsection
