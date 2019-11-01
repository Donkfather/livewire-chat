<?php
use App\Http\Controllers\LoginController;

Route::livewire('/','room')->middleware('auth')->name('home');
Route::redirect('/home','/');

Route::get('/login',[LoginController::class, 'show'])->middleware('guest')->name('login');

Route::get('/login/facebook', [LoginController::class, 'redirectToProvider'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class, 'handleProviderCallback'])->name('login.facebook.callback');

Route::get('/logout', function (){
    \Auth::logout();
    return redirect()->route('login');
})->name('logout');
