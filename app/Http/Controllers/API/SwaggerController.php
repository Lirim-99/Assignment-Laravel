<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use OpenApi\Generator;

class SwaggerController extends Controller
{
    public function getDocs()
{
    $openapi = Generator::scan([base_path('app')]);
    return response($openapi->toYaml(), 200, [
        'Content-Type' => 'application/x-yaml',
    ]);
}

    public function generateSwagger()
    {
        $openapi = Generator::scan([app_path('Http/Controllers'), app_path('Models')]);
        return response()->json($openapi->toArray()); // Convert to array for proper JSON response
    }
}
