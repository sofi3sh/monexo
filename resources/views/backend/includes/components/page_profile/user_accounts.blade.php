{{-- Форма с реквизитами пользователя --}}
<form action="{{ route('home.profile.requisites-post') }}" method="POST" class="base_form">
    @csrf
    {{ method_field('POST') }}

    <h2 class="title">@lang('cabinet_profile.accounts.title')</h2>
    <div class="block">
        <label for="visa">@lang('cabinet_profile.accounts.card')</label>
        <input type="text" id="visa" name="visa" value="{{ old('visa', $user->visa ?? '') }}">
    </div>
    <div class="block">
        <label for="webmoney">@lang('cabinet_profile.accounts.payeer')</label>
        <input type="text" id="webmoney" name="webmoney" value="{{ old('webmoney', $user->webmoney ?? '') }}">
    </div>
    <div class="block">
        <label for="mastercard">@lang('cabinet_profile.accounts.perfect_money')</label>
        <input type="text" id="mastercard" name="mastercard" value="{{ old('mastercard', $user->mastercard ?? '') }}">
    </div>
    <div class="block">
        <label for="qiwi">@lang('cabinet_profile.accounts.qiwi')</label>
        <input type="text" id="qiwi" name="qiwi" value="{{ old('qiwi', $user->qiwi ?? '') }}">
    </div>
    
    <div class="control">
        <p class="info">@lang('cabinet_profile.accounts.info')</p>
        <button type="submit">@lang('cabinet_profile.accounts.submit')</button>
    </div>
</form>