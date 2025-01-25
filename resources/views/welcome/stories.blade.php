@if ($stories->count())
    <section id="stories-area" class="section-wrapper">
        <div class="container stories-carousel-wrapper">
            <h2 class="section-title">@lang('helal.human-stories')</h2>
            <div class="swipper-container">

                <div class="btn-prev"><i class="fa fa-chevron-left"></i></div>
                <div class="btn-next"><i class="fa fa-chevron-right"></i></div>

                <div class="swiper stories-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($stories as $story)
                            <div class="swiper-slide container" data-aos="fade-up">
                                <a href="{{ route('home.show', $story->id) }}" class=" d-block row"
                                    style="direction:@if ($story->$detail->lang == 'en') ltr @else rtl @endif">
                                    <div class="row">
                                        <div class="col-md-6 story-img">
                                            <img src="{{ getImgUrl($story->image_id) }}" alt="">
                                        </div>
                                        <div class="col-md-6 mb-5">
                                            <div class="story-content bg-white p-3 shadow">
                                                <h3 class="text-salmon">{{ $story->$detail->title }}</h3>
                                                <p>{{ $story->date }}</p>
                                                <div class="d-none">
                                                    {!! $story->$detail->content !!}
                                                </div>
                                                <div class="summary mb-3" data-length="{{ $story->summary_length }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
@endif

@push('js')
    <script>
        var swiper = new Swiper(".stories-swiper", {
            slidesPerView: 1,
            navigation: {
                nextEl: ".#stories-area .btn-next",
                prevEl: ".#stories-area .btn-prev",
            },
        });
    </script>
@endpush
