<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers\User'], function () {
    Route::post('/store-user', \App\Http\Controllers\User\StoreController::class)->name('user.store');
    Route::get('/', \App\Http\Controllers\User\IndexController::class)->name('user.index');
});





