<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function emailCheckCreate(Request $request)
    {
        $email = $request->email;
        return view('auth.emailCheck', compact('email'));
    }

    public function emailCheckStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users,email']
        ]);

        $user = User::where('email', $request->email)->first();
        $state = $user->state;
        $email = $user->email;

        if ($state == 'normal')
            return redirect()->route('login.create', $email);

        elseif ($state == 'new')
            return redirect()->route('resetPassword.create', $email)
                ->with("success", "الحساب $email جديد ينبغي اختيار كلمة المرور");

        elseif ($state == 'reset')
            return redirect()->route('resetPassword.create', $email)
                ->with("error", "تم تصفير كلمة المرور الخاصة بالحساب $email من قبل الآدمن - اختر كلمة المرور");

        elseif ($state == 'banned')
            return back()
                ->with("error", "الحساب $email مقفل");
    }

    public function loginCreate($email): View
    {
        return view('auth.login', compact('email'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function loginStore(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || $user->state != 'normal')
            return back()->with('error', 'يوجد خطأ في حالة الحساب');

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function resetPasswordCreate($email): View
    {
        return view('auth.reset-password', compact('email'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function resetPasswordStore(LoginRequest $request)
    {        
        $user = User::where('email', $request->email)->first();
        if (!($user && ($user->state == 'new' || $user->state == 'reset')))
            return back()->with('error', 'يوجد خطأ في حالة الحساب');

        $user->update([
            'password' => Hash::make($request->password),
            'state' => 'normal'
        ]);

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
