<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest' , 'ar-lang'])->group(function () {    
    Route::get('email-check', [AuthenticatedSessionController::class, 'emailCheckcreate'])->name('login');
    Route::post('email-check', [AuthenticatedSessionController::class, 'emailCheckstore'])->name('emailCheck.store');
    Route::get('login/{email}', [AuthenticatedSessionController::class, 'loginCreate'])->name('login.create');
    Route::post('login', [AuthenticatedSessionController::class, 'loginStore'])->name('login.store');
    Route::get('reset-password/{email}', [AuthenticatedSessionController::class, 'resetPasswordCreate'])->name('resetPassword.create');
    Route::post('reset-password', [AuthenticatedSessionController::class, 'resetPasswordStore'])->name('resetPassword.store');
});

Route::middleware('auth')->group(function () {    
    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
