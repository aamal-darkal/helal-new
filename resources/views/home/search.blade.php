@extends('layouts.app')
@section('title', __('helal.home'))
@section('content')
    <div class="view-wrapper">
        <hr class="content-divider">
        <div class="view-title">
            <h2 class="text-salmon"> {{ $key }}</h2>
            <select name="type" onchange="getUrl(this.value)">
                <option value="" hidden>@lang('helal.choose-type')</option>
                @foreach (config('app.section-type') as $option)
                    <option value="{{ $option }}" @selected(in_array( $option , $type??[])) @if($option == 'page') hidden @endif>
                        {{ trans_choice("helal.$option", 2) }}</option>
                @endforeach
            </select>
        </div>
        @foreach ($results as $result)
            <div class="topic">
                <div class="topic-desc">
                    <p class="m-0"> <i class="far fa-clock text-salmon"></i> &nbsp; {{ $result->date }}</p>
                    <h4>{{ $result->$detail->title }}</h4>
                    <a href="{{ route('home.show', $result) }}" class="btn btn-sm btn-outline-secondary mt-2">@lang('helal.readmore')
                    </a>
                </div>
                <div class="img-wrapper">
                    <div class="search-type">@choice("helal.$result->type", 1) </div>
                    <img src="{{ $result->image_id ? asset(getImgUrl($result->image_id)) : '' }}">
                </div>
            </div>
        @endforeach

        @if ($results->count())
            <div class="border-top pt-2">
                {{ $results->links() }}.
            </div>
        @else
            <p> @lang('helal.notFound') </p>
        @endif
    </div>
    <div class="text-center"><a class="btn btn-salmon my-3 " href="{{ url()->previous() }}">@lang('helal.back')</a>



    @endsection
