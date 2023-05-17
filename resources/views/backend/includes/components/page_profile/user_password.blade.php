{{-- Resset password --}}
<form action="{{ route('home.profile.password.path') }}" method="POST" class="base_form">
    @csrf
    {{ method_field('patch') }}

    <h2 class="title">@lang('cabinet_profile.pass_reset.title')</h2>
    <div class="block">
        <label for="password">@lang('cabinet_profile.pass_reset.new_pass')</label>
        <input type="password" id="password" name="password">
    </div>
    <div class="block">
        <label for="password_confirmation">@lang('cabinet_profile.pass_reset.conf_pass')</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
    </div>
    
    <div class="control">
        <p class="info">@lang('cabinet_profile.pass_reset.info')</p>
        <button type="submit">@lang('cabinet_profile.pass_reset.submit')</button>
    </div>
</form>