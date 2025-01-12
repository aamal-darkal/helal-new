@extends('dashboard.layouts.app')
@section('title', 'تعديل كلمة السر')
@section('content')
    <h4> تعديل كلمة السر</h4>

    <form action="{{ route('dashboard.profile.update') }}" method="post" name="changeP" onsubmit="return checkPassword()">
        @csrf
        @method('patch')
        
        <x-input name="current_password" label="كلمة المرور القديمة" type="password" required maxlength="30" />
        <x-input name="password" label="كلمة المرور الجديدة" type="password" required maxlength="30" minlength="8"/>
        <x-input name="password_confirmation"  label="تأكيد كلمة المرور" type="password" required  minlength="8" />        
        <div id="msg" class="text-danger d-none pb-2">كلمتا السر غير متطابقتين</div>
        <button class="btn btn-secondary">حفظ كلمة المرور  </button>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">عودة</a>
    </form>
@endsection
@push('js')
    <script>
        function checkPassword(){
            if (changeP.password.value != changeP.password_confirmation.value){
                document.getElementById('msg').classList.remove('d-none')
                return false
            }
            else
                return true
        }
    </script>
@endpush
