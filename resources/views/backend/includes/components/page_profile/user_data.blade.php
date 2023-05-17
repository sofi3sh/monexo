{{-- Имя, фамилия. Номер телефона --}}
<form action="{{ route('home.profile.patch-name-phone') }}" method="POST" class="base_form">
    @csrf
    {{ method_field('patch') }}

    <div class="block">
        <label for="name">@lang('cabinet_profile.data.name')</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}">
    </div>
    <div class="block">
        <label for="age">@lang('cabinet_profile.data.age')</label>
        <input type="number" id="age" name="age" value="{{ old('age', $user->age ?? '') }}">
    </div>
    <div class="block">
        <label for="country">@lang('cabinet_profile.data.country')</label>
        <input type="text" id="country" name="country" value="{{ old('country', $user->country ?? '') }}">
    </div>
    <div class="block">
        <label for="email">@lang('cabinet_profile.data.email')</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" readonly>
    </div>
    <div class="block">
        <label for="phone">@lang('cabinet_profile.data.phone')</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
    </div>
    
    <div class="control">
        <p class="info">@lang('cabinet_profile.data.info')</p>
        <button type="submit">@lang('cabinet_profile.data.submit')</button>
    </div>
</form>