<section id="statistic" class="container section-wrapper">
    <div class="row">
        <div class="col-md-6 px-3 py-5 text-justify">
            <p> {{ $components['target'] }}</p>
            <p> {{ $components['about'] }}</p>
        </div>
        <div id="statics-counters" class="col-md-6 counter-wrapper row">
            
            <x-welcome.counter-item icon="fa-calendar-days" max="{{ Carbon\Carbon::parse('1-1-' . $components['years'])->age }}" title="years" />
            <x-welcome.counter-item icon="fa-location-arrow" max="{{ $components['branches'] }}" title="branches" />
            <x-welcome.counter-item icon="fa-users" max="{{ $components['volunteers'] }}" title="volunteers" />
        </div>
    </div>
    
</section>
