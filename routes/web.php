<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('template');
});

//allegro section

Route::get('/user/create', 'App\Http\Controllers\UserAllegroController@create');
Route::post('/user', 'App\Http\Controllers\UserAllegroController@store');
Route::get('/user/token', 'App\Http\Controllers\UserAllegroController@token')->middleware('auth');
Route::post('/user/token', 'App\Http\Controllers\UserAllegroController@gettoken')->middleware('auth');
Route::get('/user/token/new', 'App\Http\Controllers\UserAllegroController@createToken')->middleware('auth');
Route::get('/user/list', 'App\Http\Controllers\AdminController@list')->middleware('auth');
Route::get('/user/list/{id?}', 'App\Http\Controllers\AdminController@user')->middleware('auth');
Route::get('/user/setting', 'App\Http\Controllers\AdminController@setting')->middleware('auth');
Route::post('/user/setting', 'App\Http\Controllers\AdminController@settingstore')->middleware('auth');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
