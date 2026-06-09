<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [FrontendController::class, 'login'])->name('user-login');

//admin dashbaord routes

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');