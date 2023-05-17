{{-- Resset email --}}
<form action="{{ route('home.profile.send-email') }}" method="POST" class="base_form">
    @csrf

    <h2 class="title">@lang('cabinet_profile.email_reset.title')</h2>
    <div class="block">
        <label for="email">@lang('cabinet_profile.email_reset.new_email')</label>
        <input type="email" id="email" name="email">
    </div>
    <div class="block">
        <label for="email_confirmation">@lang('cabinet_profile.email_reset.conf_email')</label>
        <input type="email" id="email_confirmation" name="email_confirmation">
    </div>
    
    <div class="control">
        <p class="info">@lang('cabinet_profile.email_reset.info')</p>
        <button type="submit">@lang('cabinet_profile.email_reset.submit')</button>
    </div>
</form>