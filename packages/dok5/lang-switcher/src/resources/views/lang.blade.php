{{-- Если включен multi language и количество заданных языков больше 1 --}}
@if(config('locale.status') && count(config('locale.languages')) > 1)
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">{{ strtoupper(app()->getLocale()) }}</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
            @foreach(config('locale.languages') as $lang)
                @if($lang[0] != app()->getLocale() && $lang[4])
                    <small>
                        <a href="{{ '/lang/'.$lang[0] }}" class="dropdown-item">
                            {{ strtoupper($lang[0]) . ' (' . ($lang[2]) . ')' }}
                        </a>
                    </small>
                @endif
            @endforeach
        </div>
    </li>
@endif