<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [TasksController::class, 'index']);
Route::get('/tasks/create', [TasksController::class, 'create']);
Route::post('/tasks', [TasksController::class, 'store']);
Route::get('/tasks/{task}', [TasksController::class, 'show']);
Route::get('/tasks/{task}/edit', [TasksController::class, 'edit']);
Route::put('/tasks/{task}', [TasksController::class, 'update']);
Route::delete('/tasks/{task}', [TasksController::class, 'destroy']);
