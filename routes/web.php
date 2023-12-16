<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

/* BACKEND ROUTE*/
Route::get('dashboard/index', [DashboardController::class, 'index']) -> name('dashboard.index');

Route::get('admin', [AuthController::class, 'index']) -> name('auth.admin');
Route::post('login', [AuthController::class, 'login']) -> name('auth.login');