<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;


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

Route::get('/chatList/{id}', [ChatController::class, 'showList']);
Route::post('/chat', [ChatController::class, 'create']);
Route::get('/chat/{id}', [ChatController::class, 'show']);
Route::patch('/chat/{id}', [ChatController::class, 'edit']);

Route::get('/user/{key}', [UserController::class, 'findUser']);
Route::get('/user/detail/{id}', [UserController::class, 'getUser']);
