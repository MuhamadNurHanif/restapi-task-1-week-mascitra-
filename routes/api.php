<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::prefix('v1')->group(function () {
    // auth
    Route::middleware('guest')->post('/login', [AuthController::class, 'login']);
});
