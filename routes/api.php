<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/productRelation',[App\Http\Controllers\Api\ProductController::class,'relation']);
Route::get('/product',[App\Http\Controllers\Api\ProductController::class,'index']);
Route::post('/product/store',[App\Http\Controllers\Api\ProductController::class,'store']);
Route::get('/product/show/{id}',[App\Http\Controllers\Api\ProductController::class,'show']);
Route::post('/product/update/{id}',[App\Http\Controllers\Api\ProductController::class, 'update']);
Route::delete('/product/delete/{id}',[App\Http\Controllers\Api\ProductController::class, 'destroy']);
