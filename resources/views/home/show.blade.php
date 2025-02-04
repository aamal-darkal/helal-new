@extends('layouts.app')
@section('title', __('helal.home'))
@section('content')
    <div class="view-wrapper " style="direction:@if ($section->lang == 'en') ltr @else rtl @endif">
        <hr class="content-divider">
        <div class="view-cover">
            <img class="w-100 mt-2" src="{{ asset(getImgUrl($section->image_id)) }}">
            <h2 class="mt-3">{{ $section->title }}</h2>
            <div>
                {!! $section->content !!}
            </div>
            <div class="text-center my-4"><a class="btn-salmon px-3 py-2" href="{{ url()->previous() }}">@lang('helal.back')</a>
            </div>
        </div>
    </div>
    @endsection
