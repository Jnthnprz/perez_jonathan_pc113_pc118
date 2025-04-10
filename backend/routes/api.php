<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;


// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'index']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('permission');

// Employee Routes
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'create']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

// Student Routes
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'create']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);




Route::middleware('permission')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    
    
});
