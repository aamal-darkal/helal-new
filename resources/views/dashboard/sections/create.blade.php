@extends('dashboard.layouts.app')
@section('title', 'إضافة ' . __("helal.section-types.$type.singular"))
@section('content')
    <h4 class="title"> إضافة {{ __("helal.section-types.$type.singular") }}

        @if ($menu)
            لبند القائمة: {{ $menu->title_ar }}
        @endif
    </h4>
        
    <form action="{{ route('dashboard.sections.store') }}" method="post" enctype="multipart/form-data" onsubmit="readRich()"
        name="sectionForm">
        @csrf
        
        @if ($menu)
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        @endif
        
        <input type="hidden" name="type" label="" value="{{ $type }}" />
        @error('type')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
        
        <x-checkbox onchange="enable_ar()" name="arabic" label="عربي" />
        <div class="group-fields p-2 d-none">
            <x-input name="title_ar" label="العنوان بالعربي" />

            <label for="content_ar" class="form-label"> المحتوى بالعربي </label>
            <div id="content_ar" class="w-100"></div>
            <textarea name="content_ar" class="d-none">{{ old('content_ar') }}</textarea>
            @error('content_ar')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <x-checkbox onchange="enable_en()" name="english" label="انكليزي" />
        <div class="group-fields p-2 d-none">
            <x-input name="title_en" label="العنوان بالانكليزي" class="dir-ltr" />

            <label for="content_en" class="form-label"> المحتوى بالانكليزي </label>
            <div id="content_en" class="w-100"></div>
            <textarea name="content_en" class="d-none">{{ old('content_en') }}</textarea>
            @error('content_en')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <br>

        <x-input type="date" name="date" label='تاريخ ال{{ __("helal.section-types.$type.singular") }}'
            dbValue="{{ today()->toDateString() }}" />

        <x-checkbox name="hidden" label="مخفي" />

        <div class="mb-3">
            <x-input name="image_id" label="الصورة الأساسية 1400* 700" type="file" accept="image/*"
                onchange="showFile(this , 'img-review')" />

            <img class="border border-secondary" id="img-review" src="{{ asset('storage/no-image.png') }}" width="300">
        </div>

        <x-select-multiple element_id="doings" name="doings[]" label="الخدمات" :options=$doings />
        
        <x-select-multiple element_id="provinces" name="provinces[]" label="المحافظة" :options=$provinces />
        

        <div class="mb-3">
            <label for="summary_length" class="form-label">عدد محارف الجزء المعروض في الصفحة الرئيسية</label>
            <input type="number" name="summary_length" id="summary_length"
                class="form-control @error('summary_length') is-invalid @enderror"
                value="{{ getValue('news-sammery-length') }}">

            @error('summary_length')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-secondary">إضافة @lang("helal.section-types.$type.singular") </button>
        <a href="{{ route('dashboard.sections.index', ['type' => $type]) }}" class="btn btn-outline-secondary">عودة</a>

    </form>
@endsection

@push('css')
    @include('dashboard.css-components.richtext')
    @include('dashboard.css-components.multi-select')
@endpush

@push('js')
    @include('dashboard.js-components.richtext')
    @include('dashboard.js-components.multi-select')

    <script>
        var editor_ar = new RichTextEditor("#content_ar");
        var editor_en = new RichTextEditor("#content_en");


        $(document).ready(function() {
            $("#doings").chosen();
            $("#provinces").chosen();
            fillRich()
            if(sectionForm.arabic.checked)
                document.getElementById("content_ar").parentNode.classList.remove('d-none')
            if(sectionForm.english.checked)
                document.getElementById("content_en").parentNode.classList.remove('d-none')
        })

        function readRich() {
            sectionForm.content_ar.value = editor_ar.getHTMLCode();
            sectionForm.content_en.value = editor_en.getHTMLCode();
        }

        function fillRich() {
            editor_ar.setHTMLCode(sectionForm.content_ar.value);
            editor_en.setHTMLCode(sectionForm.content_en.value);
        }

        function enable_ar() {
            document.getElementById("content_ar").parentNode.classList.toggle('d-none')
        }

        function enable_en() {
            document.getElementById("content_en").parentNode.classList.toggle('d-none')
        }
    </script>

    @include('dashboard.js-components.showUploadedfile')
@endpush
