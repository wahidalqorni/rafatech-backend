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
//LOGOUT
Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');

//USER
Route::get('/user', 'App\Http\Controllers\UserController@index');
Route::get('/add-user', 'App\Http\Controllers\UserController@add');
Route::get('/edit-user/{id}', 'App\Http\Controllers\UserController@edit');
Route::post('/store-user', 'App\Http\Controllers\UserController@store');
Route::post('/update-user', 'App\Http\Controllers\UserController@update');
Route::delete('/delete-user/{id}', 'App\Http\Controllers\UserController@delete');

Route::get('/product', 'App\Http\Controllers\ProductController@index');
Route::get('/add-product', 'App\Http\Controllers\ProductController@add');
Route::get('/edit-product/{id}', 'App\Http\Controllers\ProductController@edit');
Route::post('/store-product', 'App\Http\Controllers\ProductController@store');
Route::post('/update-product', 'App\Http\Controllers\ProductController@update');
Route::delete('/delete-product/{id}', 'App\Http\Controllers\ProductController@delete');

Route::get('/order', 'App\Http\Controllers\OrderController@index');
Route::get('/edit-order/{id}', 'App\Http\Controllers\OrderController@edit');
Route::post('/update-order', 'App\Http\Controllers\OrderController@update');
Route::delete('/delete-order/{id}', 'App\Http\Controllers\OrderController@delete');
