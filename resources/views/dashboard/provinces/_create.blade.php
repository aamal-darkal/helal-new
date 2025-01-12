@extends('dashboard.layouts.app')
@section('title', 'إضافة محافظة')
@section('content')
    <h4 class="title"> إضافة محافظة</h4>
    
    <form action="{{ route('dashboard.provinces.store') }}" method="post" >
        @csrf

        <x-input name="name_ar" label="الاسم بالعربي" required maxlength="30"  />
        <x-input name="name_en" label="الاسم بالانكليزي " required maxlength="30"/>
        <x-input name="location_ar" label="العنوان بالعربي"  maxlength="255"  />
        <x-input name="location_en" label="العنوان بالانكليزي "  maxlength="255"/>
        <x-input name="phone"  label="الهاتف" maxlength="10" minlength="10" pattern="[0-9]{10}" title="10 digits"/>

        <button class="btn btn-secondary">إضافة محافظة</button>
        <a href="{{ route('dashboard.provinces.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection