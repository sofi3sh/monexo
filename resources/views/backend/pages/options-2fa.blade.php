@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="page-setings">

		{{-- Меню для страницы настроек --}}
		@include('backend.includes.partials.options-menu')		

		<div class="g-2fa">
			<div class="g-2fa__text g-2fa__text--head">Откройте мобильное приложение Google Autificaition и отсканируйте QR-код</div>
			<div class="g-2fa__qr"><img src="{{ asset('backend/img/qr.png') }}" alt=""></div>
			<div class="g-2fa__text">Если ваше устройство не поддерживает сканирование QR-кодов просто введите следующий код <span class="g-2fa--code">5165431</span></div>
			<div class="g-2fa__status">Состояние:  <span class="status-on">Включена</span></div>
			<div class="g-2fa__button button">Вылючить</div>
		</div>
		
	</div>
</div>
@endsection
