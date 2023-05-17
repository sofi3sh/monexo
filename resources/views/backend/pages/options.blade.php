@extends('layouts.app')

@section('content')
 
<div class="container-fluid">
	<div class="page-setings">

		{{-- Меню для страницы настроек --}}
		@include('backend.includes.partials.options-menu')
		
		<div class="settings-head">Данные профиля</div>
		<div class="settings-profile">
			<input type="text" class="input input--middle settings-profile__input" readonly value="Контстантин Константинопольский" placeholder="ФИО">
			<input type="text" class="input input--middle settings-profile__input" readonly value="" placeholder="Телефон">
			<input type="text" class="input input--middle settings-profile__input" readonly value="" placeholder="E-mail">
		</div>

	</div>
</div>
@endsection
