<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list-product', [App\Http\Controllers\Api\ApiProductController::class, 'listProduct']);
Route::get('/detail-product/{id}', [App\Http\Controllers\Api\ApiProductController::class, 'detailProduct']);
Route::get('/search-product', [App\Http\Controllers\Api\ApiProductController::class, 'searchProduct']);

Route::post('/post-order', [App\Http\Controllers\Api\ApiOrderController::class, 'postOrder']);