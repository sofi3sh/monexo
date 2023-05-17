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
<?php
$m_shop =  '954189166';//Config::get('payeer.m_shop');
$m_orderid = $order;
$m_amount = number_format($summ, 2, '.', '');
$m_curr = $currency;
$m_desc = base64_encode($desc);
$m_key =  'Sedtanya18';//Config::get('payeer.m_key');

$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc
);

$arHash[] = $m_key;

$sign = strtoupper(hash('sha256', implode(':', $arHash)));
?>
<div class="container">
	<h2 style="color: black;">@lang('payment.payeer.question')<?=$m_amount ?><?=$m_curr ?>@lang('payment.payeer.through')</h2>
	<form id="payeer_form" method="post" action="https://payeer.com/merchant/" target='_blank'>
	<input type="hidden" name="m_shop" value="<?=$m_shop?>">
	<input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
	<input type="hidden" name="m_amount" value="<?=$m_amount?>">
	<input type="hidden" name="m_curr" value="<?=$m_curr?>">
	<input type="hidden" name="m_desc" value="<?=$m_desc?>">
	<input type="hidden" name="m_sign" value="<?=$sign?>">
	<!--
	<input type="hidden" name="form[ps]" value="2609">
	<input type="hidden" name="form[curr[2609]]" value="USD">
	-->
	<input  type="submit" class="btn btn-green btn-balans" name="m_process" value="@lang('payment.payeer.confirm')" />
	</form>
</div>
<script type="text/javascript">
</script>
@endsection
