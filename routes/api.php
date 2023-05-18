<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Routing\RouteGroup;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/posts', function() {
//     dd('test api');
// });


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    //route untuk mendapatkan data user yang sedang login
    Route::get('/me' , [AuthenticationController::class, 'me'])->middleware(['auth:sanctum']);
    //ini untuk create data
    Route::post('/posts', [PostController::class, 'store']);
    //ini untuk update data
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware('pemilik-postingan');
    //ini untuk hapus data
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('pemilik-postingan');

    Route::post('/comment', [CommentController::class, 'store']);
    Route::patch('/comment/{id}', [CommentController::class, 'update'])->middleware('pemilik-komentar');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->middleware('pemilik-komentar');

});



Route::get('/posts', [PostController::class, 'index'])->middleware(['auth:sanctum']);

Route::get('posts/{id}', [PostController::class, 'show'])->middleware(['auth:sanctum']);

Route::get('/posts2/{id}', [PostController::class, 'show2']);

Route::post('/login', [AuthenticationController::class, 'login']);
