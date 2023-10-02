<?php

use App\Http\Controllers\API\APITasksController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('task',[APITasksController::class,'create']);
Route::get('task',[APITasksController::class,'index']);
Route::get('task/{id}',[APITasksController::class,'getTasksByID']);
Route::put('task/{id}',[APITasksController::class,'update']);
Route::post('task/done/{id}',[APITasksController::class,'markAsDone']);
Route::delete('task/{id}',[APITasksController::class,'delete']);