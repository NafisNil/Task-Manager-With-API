<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
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

#Route::get('task', [TaskController::class, 'index']);
Route::apiResource('task', TaskController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('project', ProjectController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);
});
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
