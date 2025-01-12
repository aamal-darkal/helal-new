    @if ($news->count())
        <section id="news-area" class="bg_cover section-wrapper">
            <div class="container my-3">
                <h2 class="section-title"> @lang('helal.latest-news') </h2>
                <div class="swiper news-swipper">
                    <div class="swiper-wrapper">
                        @foreach ($news as $new)
                            <div class = "swiper-slide ">
                                <div class="single-news" >                                    
                                    <a href="{{ route('home.show', $new->id) }}" style="direction:@if( $new->$detail->lang == 'en') ltr @else rtl @endif">
                                        <div class="img-wrapper">
                                            <img src="{{ asset(getImgUrl($new->image_id)) }}">
                                        </div>

                                        <h4 class="sub-title">{{ $new->$detail->title }}</h4>
                                        <div class="news-content px-2">
                                            <div class="d-none">
                                                {!! $new->$detail->content !!}
                                            </div>
                                            <div class="summary" data-length="{{ $new->summary_length }}"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
        </section>
    @endif
