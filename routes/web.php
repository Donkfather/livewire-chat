<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Route::livewire('/', 'room')->middleware('auth')->name('home');
Route::redirect('/home', '/');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');

Route::get('/login/facebook', [LoginController::class, 'redirectToProvider'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class, 'handleProviderCallback'])->name('login.facebook.callback');

if (app()->environment('local')) {
    Route::get('/login/{id}', function ($id) {
        Auth::loginUsingId($id);
        return redirect()->route('home');
    });
}

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
