<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BasicCSController;

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

Route::resource('user', UserController::class, ['only' => ['index', 'show']]);
Route::get('/user/{userId}/posts', [UserController::class, 'getUserPosts']);
Route::get('/post/{postId}/comments', [PostController::class, 'getPostComments']);
Route::post('/basic-cs/counting-sort', [BasicCSController::class, 'countingSort']);
Route::get('/basic-cs/radix-sort-with-duration', [BasicCSController::class, 'radixSortWithDuration']);
