@extends('dashboard.layouts.app')
@section('title', 'إضافة بند قائمة')
@section('content')
{{-- order + url --}}
            
    <h4 class="title"> إضافة بند في قائمة {{ $menu->title_ar }}</h4>
    
    <form action="{{ route('dashboard.menus.store') }}" method="post" >
        @csrf

        <input type="hidden" name="menu_id" value="{{ $menu->id }}" >
        <x-input name="title_ar" label="العنوان بالعربي" required maxlength="100"  />
        <x-input name="title_en" label="العنوان بالانكليزي " required maxlength="100"/>


        <button class="btn btn-secondary">  إنشاء وعرض بيانات الصفحة </button>
        <a href="{{ route('dashboard.menus.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection