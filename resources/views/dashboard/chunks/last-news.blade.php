<div class="container-fluid bg-primary p-3 mt--1">
    <h2 class="h2 text-white">@lang('dinway.news.title')</h2>
    <div class="row py-4">
        @php 
            $icons = [
                '1' => [
                    'div' => 'bg-gradient-info',
                    'icon' => 'ni ni-chart-bar-32'
                ],
                '2' => [
                    'div' => 'bg-gradient-danger',
                    'icon' => 'ni ni-app'
                ],
                '3' => [
                    'div' => 'bg-gradient-primary',
                    'icon' => 'ni ni-chat-round'
                ],
                '4' => [
                    'div' => 'bg-gradient-success',
                    'icon' => 'ni ni-books'
                ],
            ];
            $i = 1;
            // $posts[1] = $posts[2] = $posts[3] = $posts[0];
        @endphp
        @foreach ($posts as $post)
            <div class="col col-md-6 col-lg-3 mb-3">
                <a href="{{route('home.blog.post.show', $post->slug)}}">
                    <div class="news-card card h-100 m-0" style="cursor: pointer !important">
                        <div class="card-body d-flex align-items-center justify-content-between p-3">
                            <h3 class="card-title h2 m-0 mb-1 mr-2" style="font-size: 16px">
                                {{$post->name}}
                            </h3>
                            <div class="icon icon-shape text-white rounded-circle shadow {{$icons[$i]['div']}}">
                                <i class="{{$icons[$i]['icon']}}"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @php $i++ @endphp
        @endforeach
    </div>
</div>