@extends('dashboard.layouts.app')
@section('title', 'تعديل ماذا نفعل')
@section('content')
    <h4 class="title"> تعديل بند ماذا نفعل</h4>
    
    <form action="{{ route('dashboard.doings.update' , $doing) }}" method="post" >
        @csrf
        @method('put')

        <x-input name="title_ar" label="العنوان بالعربي" :dbValue="$doing->title_ar" required maxlength="50"  />
        <x-input name="title_en" label="العنوان بالانكليزي " :dbValue="$doing->title_en" required maxlength="50"/>
        <x-input name="icon"  label="الصورة"  :dbValue="$doing->icon"/>

        <x-select-multiple element_id="keywords" name="keywords[]" label="الكلمات المفتاحية" :options=$keywords :dbValues=$currKeywords />        

        <button class="btn btn-secondary">تعديل البند</button>
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
