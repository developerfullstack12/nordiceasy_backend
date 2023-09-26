<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

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

// Create a new comment
Route::post('/comments', [CommentController::class, 'store']);

// Get all comments
Route::get('/comments', [CommentController::class, 'index']);

// Get a single comment
Route::get('/comments/{id}', [CommentController::class, 'show']);

// Update a comment
Route::put('/comments/{id}', [CommentController::class, 'update']);

// Delete a comment
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

