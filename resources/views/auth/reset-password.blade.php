<!DOCTYPE html>
<html lang="en">
@include('dashboard.layouts.head')

<body dir="rtl">
    <main>
        <div class="form-container d-flex justify-content-center align-items-center">
            <!-- Session Status -->
            {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
            <div class="bg-white col-sm-10 col-md-8 col-lg-6 mx-auto border border-1 border-danger m-2 p-3">
                 <h4 class="text-center login-title">
                    تسجيل دخول <br> إلى لوحة التحكم الخاصة
                    بإدارة موقع <br> <span class="text-salmon"> الهلال الأحمر العربي السوري </span>
                </h4>
                <div class="m-sm-1">
                    <div class="text-center">
                        <img class="mx-auto" src="{{ asset('assets/images/logo/logo.png') }}" alt=""
                            width="150">
                    </div>
                    @session('success')
                        <div class="alert alert-primary p-2 mt-2">
                            {{ session()->get('success') }}
                        </div>
                    @endsession

                    @session('error')
                        <div class="alert alert-danger p-2 mt-2">
                            {{ session()->get('error') }}
                        </div>
                    @endsession

                    <form method="POST" action="{{ route('resetPassword.store') }}" name="newPassword">
                        @csrf
                        <p class="text-secondary pt-2">اختر كلمة المرور للحساب {{ $email }}</p>
                        <input class="email-display" type="hidden" name="email" value="{{ old('email', $email) }}">
                        <x-input autofocus type="password" name="password" label="كلمة المرور" value="{{ old('password') }}" />
                        <x-input type="password" name="password_confirmation" label="أعد إدخال كلمةالمرور للتأكيد"
                            value="{{ old('password_confirmation') }}" />
                        <div class="text-center">
                            <button class="btn btn-danger"> حفظ كلمة المرور</button>
                            <a class="btn btn-outline-danger" href="{{ route('login', ['email' => $email]) }}">عودة</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src=" {{ asset('dashboard-assets/js/app.js') }}"></script>
</body>

</html>
