<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;



Route::get('/', function () {
    return view('welcome');
});
//frontend  routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/profile', [FrontendController::class, 'profile'])->name('profile');
Route::get('/aim-and-objective', [FrontendController::class, 'aim_objective'])->name('aim-objective');
Route::get('/intrest-group', [FrontendController::class, 'interest_group'])->name('intrest-group');




Route::get('/login', [FrontendController::class, 'login'])->name('user-login');

//admin dashbaord routes

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');