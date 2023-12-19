<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Ajax\LocationController;


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

/* BACKEND ROUTE */

Route::get('/admin', [AuthController::class, 'index']) -> name('auth.admin')->middleware('login');
Route::post('/login', [AuthController::class, 'login']) -> name('auth.login');
Route::get('/logout', [AuthController::class, 'logout']) -> name('auth.logout');

Route::group(['middleware'=>['admin']],function(){

    Route::get('/dashboard/index', [DashboardController::class, 'index']) -> name('dashboard.index');

    /* AJAX */
    Route::get('/ajax/location/getLocation', [LocationController::class, 'getLocation']) -> name('ajax.location.index');

    /* USER */
    Route::group(['prefix' => '/user'], function () {
        Route::get('/index', [UserController::class, 'index']) -> name('user.index');
        Route::get('/create', [UserController::class, 'create']) -> name('user.create');
        Route::post('/store', [UserController::class, 'store']) -> name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit']) -> where(['id' => '[0-9]+'])-> name('user.edit');
        Route::post('{id}/update', [UserController::class, 'update'])-> where(['id' => '[0-9]+']) -> name('user.update');
        Route::get('{id}/delete', [UserController::class, 'delete']) -> where(['id' => '[0-9]+'])-> name('user.delete');
    });
});





