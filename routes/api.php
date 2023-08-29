<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
// Route::middleware(['auth', 'sanctum'])->group(function () {
//     Route::resource('products', ProductController::class);
// });

Route::group(['middleware', 'auth:sanctum'], function () {
    Route::resource('products', ProductController::class);
});
