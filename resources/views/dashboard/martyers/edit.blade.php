@extends('dashboard.layouts.app')
@section('title', 'Edit Category')
@section('content')
    <h4>تعديل بيانات الشهيد </h4>

    <form action="{{ route('dashboard.martyers.update', $martyer) }}" method="post">
        @csrf
        @method('put')

        <x-input name="name_ar" :dbValue="$martyer->name_ar" label="الاسم بالعربي" required maxlength="50"  />
        <x-input name="name_en" :dbValue="$martyer->name_en" label="الاسم بالإنكليزي" required maxlength="50"/>
        <x-input name="DOD" :dbValue="$martyer->DOD" type="number" label="سنة الاستشهاد" min="1901" max="2200" />

        <x-select name="province_id" :dbValue="$martyer->province_id" label="المحافظة" :options=$provinces  />
            
        <button class="btn btn-secondary">حفظ بيانات الشهيد </button>
        <a href="{{ route('dashboard.martyers.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection
