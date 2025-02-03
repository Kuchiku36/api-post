<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('post', PostController::class);

Route::post('register', [AuthApiController::class, 'register']);

Route::post('login', [AuthApiController::class, 'login']);

Route::post('logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
