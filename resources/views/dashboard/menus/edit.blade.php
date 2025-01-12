@extends('dashboard.layouts.app')
@section('title', 'تعديل ماذا نفعل')
@section('content')
    <h4 class="title"> تعديل بند ماذا نفعل</h4>
    
    <form action="{{ route('dashboard.menus.update' , $menu) }}" method="post" >
        @csrf
        @method('put')

        <x-input name="title_ar" label="العنوان بالعربي" :dbValue="$menu->title_ar" required maxlength="100"  />
        <x-input name="title_en" label="العنوان بالانكليزي" :dbValue="$menu->title_en"  required maxlength="100"/>

    

        <button class="btn btn-secondary">حفظ وعرض بيانات الصفحة</button>
        <a href="{{ route('dashboard.menus.index') }}" class="btn btn-outline-secondary">عودة</a>
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
