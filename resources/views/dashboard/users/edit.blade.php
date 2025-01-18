@extends('dashboard.layouts.app')
@section('title', 'إضافة حساب')
@section('content')
    <h4 class="title"> تعديل حساب</h4>

    <form action="{{ route('dashboard.users.update', $user) }}" method="post">
        @csrf
        @method('put')
        <x-input name="name" :dbValue="$user->name" label="الاسم" required maxlength="50" />
        <x-input name="email" :dbValue="$user->email" label="البريد الالكتروني" required maxlength="50" />
        
         <div class="mb-3 ps-2">
            <input type="checkbox" data-related-input="password"><label class="d-inline-block pe-2" for="">تغيير كلمة المرور</label>
         </div>
        <x-input name="password" label="كلمة المرور" maxlength="15" disabled />

        <div>
            <label class="form-label">نوع المستحدم</label> <br>
            <x-radio name="type" :items="['user', 'admin']" :dbValue="$user->type" />
        </div>

        <div>
            <label class="form-label">حالة المستحدم</label> <br>
            <x-radio name="state" :items="['normal', 'banned']" :dbValue="$user->state" />
        </div>

        <x-select name="province_id" :dbValue="$user->province_id" label="المحافظة" :options=$provinces />


        <button class="btn btn-secondary">تعديل حساب</button>
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection
@push('js')
    <script>
        const checkBoxes = document.querySelectorAll("[data-related-input]")
        for (const checkBox of checkBoxes){
            checkBox.addEventListener('change' , function(){
                const relatedInputId = this.getAttribute('data-related-input')
                document.getElementById(relatedInputId).disabled = ! checkBox.checked
            });
        }
    </script>
@endpush
