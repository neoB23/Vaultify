<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $passwords = \App\Models\PasswordRecord::where('user_id', \Illuminate\Support\Facades\Auth::id())->latest()->get();
    return view('dashboard', compact('passwords'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('passwords', [App\Http\Controllers\PasswordController::class, 'index'])->name('passwords.index');
    Route::get('passwords/create', [App\Http\Controllers\PasswordController::class, 'create'])->name('passwords.create');
    Route::post('passwords', [App\Http\Controllers\PasswordController::class, 'store'])->name('passwords.store');
    Route::put('passwords/{passwordRecord}', [App\Http\Controllers\PasswordController::class, 'update'])->name('passwords.update');
    Route::delete('passwords/{passwordRecord}', [App\Http\Controllers\PasswordController::class, 'destroy'])->name('passwords.destroy');
    Route::get('passwords/{passwordRecord}/reveal', [App\Http\Controllers\PasswordController::class, 'reveal'])->name('passwords.reveal');
    Route::post('passwords/{passwordRecord}/favorite', [App\Http\Controllers\PasswordController::class, 'toggleFavorite'])->name('passwords.favorite');
    Route::view('account/security', 'account.security')->name('account.security');
    Route::post('account/change-password', [App\Http\Controllers\AccountController::class, 'changePassword'])->name('account.change-password');
    Route::post('account/2fa/enable', [App\Http\Controllers\AccountController::class, 'enable2FA'])->name('account.2fa.enable');
    Route::post('account/2fa/disable', [App\Http\Controllers\AccountController::class, 'disable2FA'])->name('account.2fa.disable');
});

require __DIR__.'/settings.php';
