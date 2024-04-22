<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;

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

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::apiResource("/tasks", TaskController::class)->middleware("auth:sanctum");
Route::post("/register", RegisterController::class)->middleware("guest");
Route::post("/login", LoginController::class)->middleware("guest");
