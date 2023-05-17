@extends('layouts.dinway', ['title' => 'dinway.pages.faq'])



@section('content')
    
    <main>
        <section class="unsubscribe section">
            <div class="container unsubscribe__container">
                <h1 class="title mb-3 text-center">@lang('dinway.news-unsubscribe.title')</h1>
                <div class="unsubscribe__content">
                    <form class="unsubscribe-form" action="{{route('website.news-unsubscribe.delete')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="unsubscribe-form__text">
                            <p>@lang('dinway.news-unsubscribe.confirm')</p>
                        </div>
                        <input type="hidden" name="email" value="{{$email}}">
                        <button type="submit" class="btn-transparent">@lang('dinway.btns.unsubscribe')</button>
                    </form>
                    <picture>
                        <source srcset="{{asset('img/frontsite/news/unsubscribe.webp')}}" type="image/webp">
                        <img src="{{asset('img/frontsite/news/unsubscribe.png')}}" alt="">
                    </picture>
                </div>
            </div>
        </section>
    </main>

    


    

    
@endsection
