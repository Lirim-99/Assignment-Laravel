<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\API\SwaggerController;

Route::middleware(['api', 'Accept : Application/jsonaccept.json'])->group(function () {
    // Employee routes
    Route::apiResource('employees', EmployeeController::class);



    // Swagger/OpenAPI documentation routes
    Route::get('docs/api-docs.json', [SwaggerController::class, 'generateSwagger']);
    Route::get('docs', [SwaggerController::class, 'getDocs']);
    Route::get('/api/documentation', [SwaggerController::class, 'getDocs']);
});
