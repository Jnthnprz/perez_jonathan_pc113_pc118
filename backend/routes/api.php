<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;



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


// User Routes
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/view', [UserController::class, 'current_user']);
Route::post('/upload-document', [UserController::class, 'uploadDocument']);
Route::get('/documents', [UserController::class, 'listDocuments']);
Route::get('/getusers', [UserController::class, 'getUser']);
Route::get('/users', [UserController::class, 'index']);


//products
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/products/{id}', [ProductController::class, 'show']);



//sales
Route::post('/sales', [SalesController::class, 'store']);
Route::get('/sales', [SalesController::class, 'index']);

// Registration Route (moved outside middleware)
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'current_user']); // Protected route
Route::middleware('auth:sanctum')->post('/upload-document', [UserController::class, 'uploadDocument']); // Protected route for file upload

// Protected Routes
Route::middleware('permission')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});