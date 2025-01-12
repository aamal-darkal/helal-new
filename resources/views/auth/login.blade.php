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

                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf
                        <p class="text-secondary pt-2">أدخل كلمة المرور الخاصة بالحساب {{ $email }}</p>
                        <input class="email-display" type="hidden" name="email" value="{{ $email }}">
                        <x-input autofocus type="password" name="password" label="كلمة المرور" />
                        @error('email')
                            <div class="text-danger mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                        <x-checkbox name="remember" type="checkbox" label="تذكرني" />
                        <div class="text-center">
                            <button class="btn btn-danger"> تسجيل دخول</button>
                            <a class="btn btn-outline-danger" href="{{ route('login', ['email' => $email]) }}">عودة</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>

</body>

</html>
