<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('user', UserController::class);
Route::resource('jurusan', JurusanController::class);
