<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GeneralController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'getMe']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('tags', [GeneralController::class, 'getTags']);
Route::get('authors', [GeneralController::class, 'getAuthors']);
Route::get('genres', [GeneralController::class, 'getGenres']);

Route::apiResource('movies', MovieController::class);

Route::post('movies/{id}/comments', [MovieController::class, 'addComment']);
