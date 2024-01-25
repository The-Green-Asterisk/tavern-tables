<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controllers\Home::class, 'index'])->name('home');
Route::get('/signup', [Controllers\Session::class, 'signupForm'])->name('signup-form');
Route::post('/signup', [Controllers\Session::class, 'signup'])->name('signup');
Route::get('/login', [Controllers\Session::class, 'loginForm'])->name('login-form');
Route::post('/login', [Controllers\Session::class, 'login'])->name('login');
Route::get('/logout', [Controllers\Session::class, 'logout'])->name('logout');
Route::get('/forgot-password', [Controllers\Session::class, 'forgotPassword'])->name('forgot-password');

Route::get('/tavern/{id}', [Controllers\Tavern::class, 'index'])->name('tavern');
Route::get('/tavern/create', [Controllers\Tavern::class, 'createForm'])->name('create-tavern-form');