<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\LangController;
use App\Http\Controllers\Dashboard\DoingController;
use App\Http\Controllers\Dashboard\FileUploadController;
use App\Http\Controllers\Dashboard\ProvinceController;
use App\Http\Controllers\Dashboard\KeywordController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\MartyerController;
use App\Http\Controllers\Dashboard\MenuController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\XxxxxController;
use App\Http\Controllers\HomeController as DashboardHomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

require __DIR__ . '/auth.php';

/** ------------------- client ------------------ */
Route::get('/language', LangController::class)->name('language');

/** ------------------- dashboard ------------------ */
Route::middleware(['auth', 'verified', 'ar-lang'])
    ->get('dashboard', [DashboardHomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'verified', 'ar-lang'])
    ->prefix('dashboard/')->name('dashboard.')->group(function () {
        Route::resource('sections', SectionController::class);
        Route::resource('xxxxxes', XxxxxController::class);
        Route::resource('fileUploads', FileUploadController::class)->except('show', 'edit', 'update');
        Route::resource('martyers', MartyerController::class)->except('show');
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::middleware('admin')->group(function () {
            Route::resource('settings', SettingController::class)->only('index', 'update');
            Route::resource('doings', DoingController::class);
            Route::resource('keywords', KeywordController::class)->except('show', 'edit', 'update');
            Route::resource('menus', MenuController::class);
            Route::resource('provinces', ProvinceController::class)->only('index', 'edit', 'update');
            Route::resource('users', UserController::class)->except('show', 'destroy');
            Route::post('users/reset-password/{user}', [UserController::class, 'resetPassword'])->name('users.reset-password');
            Route::post('users/lock/{user}', [UserController::class, 'lock'])->name('users.lock');
        });
    });
Route::get('users/email-check', [AuthenticatedSessionController::class, 'emailCheck'])->name('users.emailCheck');

/** client */
Route::get('/', [HomeController::class,  'index'])->name('home.index');
Route::get('/show/{section}', [HomeController::class,  'show'])->name('home.show');
Route::get('/showXxxxx/{xxxxx}', [HomeController::class,  'showXxxxx'])->name('home.showXxxxx');
Route::get('/search', [HomeController::class,  'search'])->name('home.search');

// ****************** startup ********************/

Route::get('artisan/{cmd}', function ($cmd) {
    Artisan::call($cmd);
});
Route::get('test', function (Request $request) {
    Storage::disk('public')->delete("files/IMAGE/b-1735208118.png");
    return "ok";
});
