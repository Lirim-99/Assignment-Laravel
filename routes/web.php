<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('welcome');
});
Route::resource('employees', EmployeeController::class);
Route::get('/', [EmployeeController::class, 'index']);


Route::get('/api/docs', function() {
    $swagger = \OpenApi\scan(app_path('Http/Controllers'));
    return response()->json($swagger);
});

