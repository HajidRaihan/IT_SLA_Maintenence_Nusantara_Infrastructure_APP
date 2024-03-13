<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthenticationController;


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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthenticationController::class, 'logout']);
});
Route::get('/tes', function () {
    return "tes";
});

Route::get('/users', [UserController::class, 'index']);
Route::post('/users/update/{id}', [UserController::class, 'updateProfile']);

Route::post('/toll', [ActivityController::class,'addactivity_toll']);
Route::get('/toll', [ActivityController::class,'getactivity_toll']);
Route::put('/toll/update/{id}', [ActivityController::class,'edit_activity']);
Route::delete('/toll/delete/{id}', [ActivityController::class,'delete_activity']);
Route::post('/nontoll', [ActivityController::class,'addactivity_nontoll']);
Route::get('/nontoll', [ActivityController::class,'getactivity_nontoll']);
Route::put('/nontoll/update/{id}', [ActivityController::class,'edit_activitynontoll']);
Route::delete('/nontoll/delete/{id}', [ActivityController::class,'delete_activitynontoll']);






