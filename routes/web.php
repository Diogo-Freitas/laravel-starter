<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', '2fa', 'verified', 'approved'])->group(function () {
    /* ===== DASHBOARD ===== */
    Route::get('/panel/dashboard', [App\Http\Controllers\Panel\DashboardController::class, 'index'])->name('panel.dashboard');
    /* ===== PROFILE ===== */
    Route::get('/panel/profile', [App\Http\Controllers\Panel\ProfileController::class, 'index'])->name('panel.profile');
    Route::put('/panel/profile', [App\Http\Controllers\Panel\ProfileController::class, 'updateProfile'])->name('panel.profile.update');
    Route::put('/panel/profile/avatar-update', [App\Http\Controllers\Panel\ProfileController::class, 'updateAvatar'])->name('panel.profile.avatar.update');
    Route::get('/panel/profile/avatar-destroy', [App\Http\Controllers\Panel\ProfileController::class, 'destroyAvatar'])->name('panel.profile.avatar.destroy');
    Route::put('/panel/profile/password-update', [App\Http\Controllers\Panel\ProfileController::class, 'updatePassword'])->name('panel.profile.password.update');
    Route::get('/panel/profile/destroy', [App\Http\Controllers\Panel\ProfileController::class, 'destroy'])->name('panel.profile.destroy')->middleware('password.confirm');
    Route::put('/panel/profile/two-factor', [App\Http\Controllers\Panel\ProfileController::class, 'toggleTwoFactor'])->name('panel.profile.toggleTwoFactor');
    /* ===== TWO FACTOR AUTHENTICATION ===== */
    Route::get('two-factor-authentication', [App\Http\Controllers\Auth\TwoFactorController::class, 'show'])->name('twoFactor.show');
    Route::post('two-factor-authentication', [App\Http\Controllers\Auth\TwoFactorController::class, 'check'])->name('twoFactor.check');
    Route::get('two-factor-authentication/resend', [App\Http\Controllers\Auth\TwoFactorController::class, 'resend'])->name('twoFactor.resend');
});

Route::middleware(['auth', 'admin', '2fa', 'verified', 'approved'])->group(function () {
    /* ===== USER ===== */
    Route::get('/panel/user', [App\Http\Controllers\Panel\UserController::class, 'index'])->name('panel.user');
    Route::get('/panel/user/show/{user}', [App\Http\Controllers\Panel\UserController::class, 'show'])->name('panel.user.show');
    Route::get('/panel/user/create', [App\Http\Controllers\Panel\UserController::class, 'create'])->name('panel.user.create');
    Route::post('/panel/user/create', [App\Http\Controllers\Panel\UserController::class, 'store'])->name('panel.user.store');
    Route::get('/panel/user/update/{user}', [App\Http\Controllers\Panel\UserController::class, 'edit'])->name('panel.user.edit');
    Route::put('/panel/user/update/{user}', [App\Http\Controllers\Panel\UserController::class, 'update'])->name('panel.user.update');
    Route::put('/panel/user/avatar-update/{user}', [App\Http\Controllers\Panel\UserController::class, 'updateAvatar'])->name('panel.user.avatar.update');
    Route::get('/panel/user/avatar-destroy/{user}', [App\Http\Controllers\Panel\UserController::class, 'destroyAvatar'])->name('panel.user.avatar.destroy');
    Route::put('/panel/user/two-factor/{user}', [App\Http\Controllers\Panel\UserController::class, 'toggleTwoFactor'])->name('panel.user.toggleTwoFactor');
    Route::delete('/panel/user/destroy/{user}', [App\Http\Controllers\Panel\UserController::class, 'destroy'])->name('panel.user.destroy');
});
