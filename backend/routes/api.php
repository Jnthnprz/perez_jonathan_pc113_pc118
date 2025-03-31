<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login']); 
Route::get('/users', [AuthController::class, 'index']);
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'create']);
Route::post('/employees', [EmployeeController::class, 'create']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
    Route::get('/students/{id}', [StudentController::class, 'show']);

    




Route::middleware('permission')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    
    
});
