<?php

use Illuminate\Support\Facades\Route;
use Ndg0\LaravelSocialiteAuth\Http\Controllers\Auth\LoginController;

Route::get('login/lsa/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('login/lsa/{provider}/callback', [LoginController::class, 'handleProviderCallback']);
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');
