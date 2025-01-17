<?php

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
     Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
     Route::apiResource('/mahasiswa', App\Http\Controllers\Api\MahasiswaController::class);
});

Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
Route::apiResource('/mahasiswa', App\Http\Controllers\Api\MahasiswaController::class);

Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'signin']);
Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'signup']);

Route::get('/posts', [App\Http\Controllers\Api\PostController::class, 'index']);
Route::get('/posts/:id', [App\Http\Controllers\Api\PostController::class, 'show']);

Route::get('/mahasiswa', [App\Http\Controllers\Api\MahasiswaController::class, 'index']);
Route::get('/mahasiswa/:id', [App\Http\Controllers\Api\MahasiswaController::class, 'show']);
Route::delete('/mahasiswa/{id}', [App\Http\Controllers\Api\MahasiswaController::class, 'destroy']);
