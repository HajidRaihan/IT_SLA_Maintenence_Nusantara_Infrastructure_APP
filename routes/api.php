<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ActivityController; // Add this line
use App\Http\Controllers\WebActivityController;
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

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('logout', [AuthenticationController::class, 'logout']);
Route::post('activities', [ActivityController::class, 'addactivity_toll']); 
Route::get('activities', [ActivityController::class, 'getactivity_toll']); 
Route::put('activities/edit/{id}', [ActivityController::class, 'edit_activity']);
Route::delete('activities/delete/{id}', [ActivityController::class, 'delete_activity']); 
Route::get('/toll-form', [WebActivityController::class, 'showForm'])->name('toll.form');


