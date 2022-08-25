<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShoppingController;

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

Route::post('user/tambah', [UserController::class,'store']);
Route::post('shopping', [ShoppingController::class,'store']);
Route::get('shopping', [ShoppingController::class,'getAll']);
Route::get('shopping/{id}', [ShoppingController::class,'getById']);
Route::put('shopping/{id}', [ShoppingController::class,'update']);
Route::delete('shopping/{id}', [ShoppingController::class,'delete']);
