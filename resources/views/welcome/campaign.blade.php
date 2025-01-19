@if ($campaign)
    <section id="campaign-area">
        <div class="title-wrapper">
            <h2 class="section-title">@lang('helal.latest-campaign')</h2>
        </div>

        <div class="px-5 center-container campaign-wrapper" style="background-image: url({{ getImgUrl($campaign->image_id) }})">
            <a href="{{ route('home.show', $campaign->id) }}" style="direction:@if( $campaign->$detail->lang == 'en') ltr @else rtl @endif">
                <h2 class="mb-5"> {{ $campaign->$detail->title }} </h2>
                <div class="d-none ">
                    {!! $campaign->$detail->content !!}
                </div>
                <h3 class="summary mb-3 campaign-content"
                    data-length="{{ $campaign->summary_length }}">
                </h3>
            </a>

        </div>
    </section>
@endif
