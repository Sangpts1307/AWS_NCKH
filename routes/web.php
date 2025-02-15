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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [App\Http\Controllers\HomePageController::class, 'postLogin']);
Route::group(['middleware' => 'checkLogin'], function(){
    Route::get('/homePage', [App\Http\Controllers\HomePageController::class, 'homePage']);
    Route::post('/upload', [App\Http\Controllers\HomePageController::class, 'upload']);
    Route::get('/download/{id}', [App\Http\Controllers\HomePageController::class, 'download']);
    Route::get('/delete/{id}', [App\Http\Controllers\HomePageController::class, 'delete']);
    Route::get('/logout', [App\Http\Controllers\HomePageController::class, 'logout']);
});


