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

Route::get('/admin',[\App\Http\Controllers\AdminController::class,'index']);
Route::post('admin/store',[\App\Http\Controllers\AdminController::class,'store']);
Route::post('admin/update/{id}',[\App\Http\Controllers\AdminController::class,'update']);
Route::get('admin/destroy/{id}',[\App\Http\Controllers\AdminController::class,'destroy']);
