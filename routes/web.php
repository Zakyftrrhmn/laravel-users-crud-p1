<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('user', UserController::class)->middleware('auth');
Route::resource('jurusan', JurusanController::class)->middleware('auth');


Route::get('/', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('loginProses');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProses'])->name('registerProses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
