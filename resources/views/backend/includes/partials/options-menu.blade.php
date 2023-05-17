<div class="settings_menu">
    <a href="{{route('home.profile.profile')}}"
       class="button button--menu-settings  {{ isActive('home.profile.profile', 'is-active') }}">
        {{ __('strings.backend.profile.nav.profile') }}
    </a>
    <a href="{{route('home.profile.requisites-show')}}"
       class="button button--menu-settings  {{ isActive('home.profile.requisites-show', 'is-active') }}">
        {{ __('strings.backend.profile.nav.requisites') }}
    </a>
    <a href="{{ route('home.profile.2fa') }}"
       class="button button--menu-settings  {{ isActive('home.profile.2fa', 'is-active') }}">
        Google 2FA
    </a>
</div>