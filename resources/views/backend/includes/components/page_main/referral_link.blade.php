{{-- Блок с реферальной ссылкой --}}
<div class="main_wrapper main_referral_link">
    <div class="content">
        <div class="text">
            <h3>@lang('cabinet_home.referral_link.title')</h3>
            <p>@lang('cabinet_home.referral_link.sub_title')</p>
        </div>
        <div class="link">
            <input type="text" value="{{ $referral_link }}" readonly>
            <button class="copy">Copy</button>
        </div>
    </div>
    <div class="control">
        <div class="content">
            <div class="text">
                <h3>@lang('cabinet_home.referral_link.link')</h3>
                <p>@lang('cabinet_home.referral_link.link_text')</p>
            </div>
            <div class="link_for_link">
                <a href="https://www.facebook.com/sharer.php?u={{ $referral_link }}">
                    @include('backend.includes.partials.svg.socials.fb')
                </a>
                <a href="https://telegram.me/share/url?url=Agio.company&text=Agio.company referral link: {{ $referral_link }}">
                    @include('backend.includes.partials.svg.socials.tg')
                </a>
                <a href="https://vk.com/share.php?url={{ $referral_link }}">
                    @include('backend.includes.partials.svg.socials.vk')
                </a>
            </div>
        </div>
    </div>
</div>