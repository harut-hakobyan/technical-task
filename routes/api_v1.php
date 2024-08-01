<?php

use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\WebsiteController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('report', [ReportController::class, 'index']);
    Route::resource('websites', WebsiteController::class);
    Route::get('/websites/{id}/report', [WebsiteController::class, 'getWebsiteReport']);
})->prefix('v1');
