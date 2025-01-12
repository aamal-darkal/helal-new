@extends('dashboard.layouts.app')
@section('title', 'تعديل ' . __("helal.section-types.$type.singular"))
@section('content')

    <h4 class="title"> تعديل {{ __("helal.section-types.$type.singular") }} </h4>

    <form action="{{ route('dashboard.sections.update', $section) }}" method="post" enctype="multipart/form-data"
        onsubmit="readRich()"
         name="sectionForm">
        @csrf
        @method('put')

        @if ($menu)
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        @endif

        <input type="hidden" name="type" label="" value="{{ $type }}" />
                @error('type')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror


        <x-checkbox onchange="toggleAr()" name="arabic" label="عربي" :dbValue="$section->arabic" />
        <div class="group-fields p-2 d-none">
            <x-input name="title_ar" label="العنوان بالعربي" :dbValue="$section->sectionDetail_ar?$section->sectionDetail_ar->title:''" />

            <label for="content_ar" class="form-label"> المحتوى بالعربي </label>
            <div id="rich_ar" class="w-100"></div>
            <textarea name="content_ar" id="content_ar" class="d-none">{!! old('content_ar', $section->sectionDetail_ar?$section->sectionDetail_ar->content:'') !!}</textarea>
            @error('content_ar')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <x-checkbox onchange="toggleEn()" name="english" label="انكليزي" :dbValue="$section->english"/>
        <div class="group-fields p-2 d-none">
            <x-input name="title_en" label="العنوان بالانكليزي" class="dir-ltr" :dbValue="$section->sectionDetail_en?$section->sectionDetail_en->title:''"  />

            <label for="content_en" class="form-label"> المحتوى بالانكليزي </label>
            <div id="rich_en" class="w-100"></div>
            <textarea name="content_en" id="content_en" class="d-none">{!! old('content_en', $section->sectionDetail_en?$section->sectionDetail_en->content:'') !!}</textarea>
            @error('content_en')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <x-input type="date" :dbValue="$section->date" name="date"
            label='تاريخ ال{{ __("helal.section-types.$type.singular") }}' />

        <x-checkbox name="hidden" label="مخفي" :dbValue="$section->hidden" />

        <div class="mb-3">
            <x-input name="image_id" label="الصورة الأساسية 1400* 700" type="file" accept="image/*"
                onchange="showFile(this , 'img-review')" />
            <img class="border border-secondary" id="img-review" src="{{ getImgUrl($section->image_id) }}" width="300">
        </div>

        <x-select-multiple element_id="doings" name="doings[]" label="الخدمات" :options=$doings :dbValues="$currDoings" />

        <x-select-multiple element_id="provinces" name="provinces[]" label="المحافظة" :options=$provinces :dbValues="$currProvinces" />


        <div class="mb-3">
            <label for="summary_length" class="form-label">عدد محارف الجزء المعروض في الصفحة الرئيسية</label>
            <input type="number" name="summary_length" id="summary_length"
                class="form-control @error('summary_length') is-invalid @enderror" value="{{ $section->summary_length }}">

            @error('summary_length')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-secondary">حفظ ال{{ __("helal.section-types.$type.singular") }}</button>
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
        // Initiating the multi-select  & richtext  
        var editor_ar = new RichTextEditor("#rich_ar");
        var editor_en = new RichTextEditor("#rich_en");


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

        function toggleAr() {
            document.getElementById("content_ar").parentNode.classList.toggle('d-none')
        }

        function toggleEn() {
            document.getElementById("content_en").parentNode.classList.toggle('d-none')
        }
        
    </script>

    @include('dashboard.js-components.showUploadedfile')
@endpush
