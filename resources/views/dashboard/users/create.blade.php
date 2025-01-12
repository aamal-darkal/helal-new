@extends('dashboard.layouts.app')
@section('title', 'إضافة حساب')
@section('content')
    <h4 class="title"> إضافة حساب</h4>

    <form action="{{ route('dashboard.users.store') }}" method="post">
        @csrf

        <x-input name="name" label="الاسم" required maxlength="50" />
        <x-input name="email" label="البريد الالكتروني" required maxlength="50" />
       
        <div>
            <label class="form-label">نوع المستحدم</label> <br>

            <input class="form-check-input" name="type" type="radio" value="user" id="user" checked>
            <label for="user"> user </label>
            <input class="form-check-input me-4 mb-3" name="type" type="radio" value="admin" id="admin">
            <label for="banned"> admin </label>            
        </div>

        <x-select name="province_id" label="المحافظة"  :options=$provinces />


        <button class="btn btn-secondary">إضافة حساب</button>
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection
