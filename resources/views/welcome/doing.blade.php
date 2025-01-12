<section class="doing-list-area section-wrapper">
    <div class="container">
        <h2 class="text-center section-title"> @lang('helal.do')</h2>
        <div class="doing-list-wrapper row">
            @foreach ($doings as $doing)
                <div class="doing-list-item col-4">
                    <a href="{{ route('home.search', ['doing' => $doing]) }}" data-aos="fade-up">
                        <div>{!! $doing->icon !!}</div>
                        <h4>{{ $doing->title }}</h4>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</section>
