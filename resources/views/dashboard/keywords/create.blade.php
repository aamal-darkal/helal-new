@extends('dashboard.layouts.app')
@section('title', 'إضافة كلمة مفتاحية')
@section('content')
    <h4 class="title"> إضافة كلمة مفتاحية</h4>
    
    <form action="{{ route('dashboard.keywords.store') }}" method="post" >
        @csrf

        <x-input name="word_ar" label="الكلمة بالعربي" required maxlength="30"  />
        <x-input name="word_en" label="الكلمة بالانكليزي " required maxlength="30"/>

        <button class="btn btn-secondary">إضافة كلمة مفتاحية</button>
        <a href="{{ route('dashboard.keywords.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection