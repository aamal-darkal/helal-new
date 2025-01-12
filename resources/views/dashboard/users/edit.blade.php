@extends('dashboard.layouts.app')
@section('title', 'إضافة حساب')
@section('content')
    <h4 class="title"> تعديل حساب</h4>
    
    <form action="{{ route('dashboard.users.update' , $user) }}" method="post" >
        @csrf
        @method('put')
        <x-input name="name" :dbValue="$user->name" label="الاسم" required maxlength="50"  />
        <x-input name="email" :dbValue="$user->email" label="البريد الالكتروني" required maxlength="50"/>
        <div>
            <label class="form-label">نوع المستحدم</label> <br>

            <input class="form-check-input" name="type" type="radio" value="user" id="user" @checked($user->type == 'user')>
            <label for="user"> user </label>
            <input class="form-check-input me-4 mb-3" name="type" type="radio" value="admin" id="admin" @checked($user->type == 'admin')>
            <label for="banned"> admin </label>            
        </div>
        <x-select name="province_id" :dbValue="$user->province_id" label="المحافظة" :options=$provinces  />


        <button class="btn btn-secondary">تعديل حساب</button>
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection

