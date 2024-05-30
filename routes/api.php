<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\API\SwaggerController;

Route::middleware(['api', 'Accept : Application/jsonaccept.json'])->group(function () {
    // User routes

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    

    // Employee routes
    Route::apiResource('employees', EmployeeController::class);

    Route::get('/', function () {
        return view('welcome');
    });
    Route::group(['prefix' => 'api/'], function () {

        Route::get('dashboard', 'EmployeeController@index');

    });

    // Swagger/OpenAPI documentation routes
    Route::get('docs/api-docs.json', [SwaggerController::class, 'generateSwagger']);
    Route::get('docs', [SwaggerController::class, 'getDocs']);
    Route::get('/api/documentation', [SwaggerController::class, 'getDocs']);
});
