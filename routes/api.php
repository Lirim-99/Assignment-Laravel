<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\API\SwaggerController;

Route::middleware(['api', 'Accept : Application/jsonaccept.json'])->group(function () {
    // User routes

    Route::get('/users', [UserController::class, 'indexSwagger']);
    Route::post('/users', [UserController::class, 'storeSwagger']);
    Route::get('/users/{id}', [UserController::class, 'showSwagger']);

    // Employee routes
    Route::apiResource('employees', EmployeeController::class);

    // Swagger/OpenAPI documentation routes
    Route::get('docs/api-docs.json', [SwaggerController::class, 'generateSwagger']);
    Route::get('docs', [SwaggerController::class, 'getDocs']);
    Route::get('/api/documentation', [SwaggerController::class, 'getDocs']);
});
