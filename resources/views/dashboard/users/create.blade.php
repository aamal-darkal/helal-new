@extends('dashboard.layouts.app')
@section('title', 'إضافة حساب')
@section('content')
    <h4 class="title"> إضافة حساب</h4>

    <form action="{{ route('dashboard.users.store') }}" method="post">
        @csrf

        <x-input name="name" label="الاسم" required maxlength="50" />
        <x-input name="email" label="البريد الالكتروني" required maxlength="50" />
        <x-input name="password" label="كلمة المرور" required maxlength="15" />
       
        <div>
            <label class="form-label">نوع المستحدم</label> <br>
            <x-radio name="type" :items="['user' , 'admin']" dbValue="user"/>
        </div>
        
        <div>
            <label class="form-label">حالة المستحدم</label> <br>
            <x-radio name="state" :items="['normal' , 'banned']" dbValue="normal" />
        </div>

        <x-select name="province_id" label="المحافظة"  :options=$provinces />


        <button class="btn btn-secondary">إضافة حساب</button>
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection
