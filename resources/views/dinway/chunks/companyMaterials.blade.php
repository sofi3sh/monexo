@if($companyMaterials->count())
    <section class="company-materials section">
        <div class="container company-materials__container">
            <h2 class="title text-center mb-3">@lang('dinway.company-materials.title')</h2>
            @foreach ($companyMaterials as $material)
                <div class="company-material">
                    <div class="company-material__text">
                        <h3 class="company-material__title">{{$material->name}}</h3>
                        <p class="company-material__desc">{{$material->describe}}</p>
                        <div class="share" >
                            <h4 class="share__title">@lang('dinway.company-materials.share')</h4> 
                            <ul class="share__list">
                                <li>
                                    <a aria-label="Share in facebook" href="https://www.facebook.com/sharer/sharer.php?u={{$material->pdf}}">
                                        <svg fill="#1448B6" width="30" height="30">
                                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#fb"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a aria-label="Share in telegram" href="https://t.me/share/url?url={{$material->pdf}}&text={{$material->name . '%0A' . $material->describe}}">
                                        <svg fill="#1448B6" width="30" height="30">
                                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#telegram"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a aria-label="Share in mail" href="mailto:info@example.com?&subject=&body={{$material->pdf}}">
                                        <svg fill="#1448B6" width="30" height="30">
                                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#email"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a aria-label="Share in vk" href="http://vk.com/share.php?url={{$material->pdf}}&title={{$material->name}}&description={{$material->describe}}&noparse=true">
                                        <svg fill="#1448B6" width="30" height="30">
                                            <use xlink:href="{{asset('img/frontsite/svg/sprite.svg')}}#vk"></use>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="company-material__btns">
                        <a href="{{$material->pdf}}" class="btn-blue company-material__btn">@lang('dinway.company-materials.pdf')</a>
                        
                    </div>
                </div>    
            @endforeach
        </div>
    </section>
@endif
