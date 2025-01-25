    @if ($news->count())
        <section id="news-area">
            <div class="section-wrapper">
                <div class="container">
                    <h2 class="section-title"> @lang('helal.latest-news') </h2>
                    <div class="swipper-container">
                        <div class="btn-prev"><i class="fa fa-chevron-left"></i></div>
                        <div class="btn-next"><i class="fa fa-chevron-right"></i></div>

                        <div class="swiper news-swipper">
                            <div class="swiper-wrapper">
                                @foreach ($news as $new)
                                    <div class = "swiper-slide">
                                        <div class="single-news">
                                            <a href="{{ route('home.show', $new->id) }}"
                                                style="direction:@if ($new->$detail->lang == 'en') ltr @else rtl @endif">
                                                <div class="img-wrapper">
                                                    <img src="{{ asset(getImgUrl($new->image_id)) }}">
                                                </div>

                                                <h4 class="sub-title"> @choice("helal.$new->type", 1) </h4>
                                                <div class="px-3">
                                                    <p class="m-1">{{ $new->date }}</p>
                                                    <div class="news-content">
                                                        <div class="d-none">
                                                            {!! $new->$detail->content !!}
                                                        </div>
                                                        <div class="summary" data-length="{{ $new->summary_length }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="search?type[]=news&type[]=article" class="btn btn-salmon mt-3"> @lang('helal.readmore')</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    @endif
    @push('js')
        <script>
            var swiper = new Swiper(".news-swipper", {
                slidesPerView: 1,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {

                    500: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    800: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                },
                navigation: {
                    nextEl: "#news-area .btn-next",
                    prevEl: "#news-area .btn-prev",
                },
            });
        </script>
    @endpush
