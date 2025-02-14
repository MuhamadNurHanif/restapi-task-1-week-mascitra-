<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\EmployeeController;

Route::prefix('v1')->group(function () {
    // Authentication Routes
    Route::middleware('guest')->post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

    // Protected API Routes
    Route::middleware(['auth:sanctum'])->group(function () {
        // Division Routes
        Route::get('/divisions', [DivisionController::class, 'index']);

        // Employee Routes
        Route::get('/employees', [EmployeeController::class, 'index']);
        Route::post('/employees', [EmployeeController::class, 'store']);
        Route::put('/employees/{id}', [EmployeeController::class, 'update']);
        Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
    });
});
