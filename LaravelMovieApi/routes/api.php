<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudioController;


Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/movies/{id}', [MovieController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/directors', [DirectorController::class, 'index']);
Route::post('/directors', [DirectorController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/directors/{id}', [DirectorController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/directors/{id}', [DirectorController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/categories/{id}', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/studio', [StudioController::class, 'index']);
Route::post('/studio', [StudioController::class, 'store'])->middleware('auth:sanctum');
Route::patch('/studio/{id}', [StudioController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/studio/{id}', [StudioController::class, 'destroy'])->middleware('auth:sanctum');


Route::post("/users/login", [UsersController::class, 'login']);
Route::get('/users', [UsersController::class, 'index'])->middleware('auth:sanctum');


