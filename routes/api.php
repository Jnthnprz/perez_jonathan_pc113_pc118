<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\API\AuthController;


Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'create']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::post('/employees', [EmployeeController::class, 'create']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);

Route::post('/login', [AuthController::class, 'login']);
