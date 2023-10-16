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


Route::controller(\App\Http\Controllers\API\CommentController::class)->group(function () {
    Route::get('/comments', 'index');
    Route::get('/comments/{id}', 'show');
    Route::post('/comments/create', 'create');
});
Route::controller(\App\Http\Controllers\API\ReplyController::class)->group(function () {
    Route::post('/reply/{id}', 'store');
});
