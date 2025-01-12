@extends('dashboard.layouts.app')
@section('title', 'تعديل محافظة')
@section('content')
    <h4> تعديل محافظة</h4>

    <form action="{{ route('dashboard.provinces.update', $province) }}" method="post">
        @csrf
        @method('put')

        
        <x-input name="name_ar" label="الاسم بالعربي" required maxlength="30"  :dbValue="$province->name_ar" disabled/>
        <x-input name="name_en" label="الاسم بالانكليزي " required maxlength="30" :dbValue="$province->name_en" disabled/>
        <x-input name="location_ar" label="العنوان بالعربي" maxlength="255"  :dbValue="$province->location_ar" />
        <x-input name="location_en" label="العنوان بالانكليزي" maxlength="255" :dbValue="$province->location_en"/>
        <x-input name="phone"  label="الهاتف" :dbValue="$province->phone" maxlength="10" minlength="10" pattern="[0-9]{10}" title="10 digits"/>        

        

        <button class="btn btn-secondary">حفظ بيانات المحافظة </button>
        <a href="{{ route('dashboard.provinces.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection
