@extends('dashboard.layouts.app')
@section('title', 'إضافة ماذا نفعل')
@section('content')
    <h4 class="title"> إضافة بند ماذا نفعل</h4>
    
    <form action="{{ route('dashboard.doings.store') }}" method="post" >
        @csrf

        <x-input name="title_ar" label="العنوان بالعربي" required maxlength="50"  />
        <x-input name="title_en" label="العنوان بالانكليزي " required maxlength="50"/>
        <x-input name="icon"  label="الصورة" />
        <x-select-multiple element_id="keywords" name="keywords[]" label="الكلمات المفتاحية" :options=$keywords />


        <button class="btn btn-secondary">إضافة البند</button>
        <a href="{{ route('dashboard.doings.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection

@push('css')
    @include('dashboard.css-components.multi-select')
@endpush

@push('js')
    @include('dashboard.js-components.multi-select')

    <script>
        // Initiating the multi-select    

        $(document).ready(function() {
            $("#keywords").chosen();
        })
    </script>

@endpush
