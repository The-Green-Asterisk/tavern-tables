<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TavernController;
use App\Http\Controllers\TableController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/signup', [SessionController::class, 'signupForm'])->name('signup-form');
Route::post('/signup', [SessionController::class, 'signup'])->name('signup');
Route::get('/login', [SessionController::class, 'loginForm'])->name('login-form');
Route::post('/login', [SessionController::class, 'login'])->name('login');
Route::get('/logout', [SessionController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [SessionController::class, 'forgotPassword'])->name('forgot-password');

Route::get('/tavern/{tavern}', [TavernController::class, 'index'])->name('tavern');
Route::get('/tavern/create', [TavernController::class, 'createTavernForm'])->name('create-tavern-form');
Route::post('/tavern/create', [TavernController::class, 'create'])->name('create-tavern');

Route::get('/tavern/{tavern}/table/create', [TableController::class, 'createTableForm'])->name('create-table-form');
Route::post('/tavern/{tavern}/table/create', [TableController::class, 'create'])->name('create-table');

Route::post('/table/add-player', [TableController::class, 'addPlayer'])->name('add-player');