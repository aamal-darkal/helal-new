@extends('dashboard.layouts.app')
@section('title', 'إضافة شاغر')
@section('content')
    <h4 class="title"> إضافة شاغر </h4>

    <form action="{{ route('dashboard.xxxxxes.store') }}" method="post" enctype="multipart/form-data" onsubmit="readRich()"
        name="xxxxxForm">
        @csrf

        <x-input name="title" label="العنوان" />

        <label for="content" class="form-label"> المحتوى </label>
        <div id="content"></div>
        <textarea name="content" class="d-none">{{ old('content') }}</textarea>
        @error('content')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
            <br>
            
        
        <x-input type="date" name="date" label='تاريخ الشاغر' dbValue="{{ today()->toDateString()}}" />

        <x-checkbox name="hidden" label="مخفي" />

        <div class="mb-3">
            <x-input name="image_id" label="الصورة الأساسية 1400* 700" type="file" accept="image/*"
                onchange="showFile(this , 'img-review')" />

            <img class="border border-secondary" id="img-review" src="{{ asset('storage/no-image.png') }}" width="300">
        </div>

        <x-select name="province_id" label="المحافظة" :options=$provinces required/>


        <button class="btn btn-secondary">إضافة شاغر </button>
        <a href="{{ route('dashboard.xxxxxes.index') }}" class="btn btn-outline-secondary">عودة</a>

    </form>
@endsection

@push('css')
    @include('dashboard.css-components.richtext')
@endpush

@push('js')
    @include('dashboard.js-components.richtext')

    <script>
        // Initiating the multi-select  & richtext  

        var editor = new RichTextEditor("#content");
       
        function fillRich() {
            editor.setHTMLCode(xxxxxForm.content.value);
        }

        function readRich() {
            xxxxxForm.content.value = editor.getHTMLCode();
        }
    </script>

    @include('dashboard.js-components.showUploadedfile')
@endpush
