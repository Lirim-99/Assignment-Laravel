<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use OpenApi\Generator;

class SwaggerController extends Controller
{
    public function getDocs()
    {
        $openapi = Generator::scan([base_path('app')]);
        header('Content-Type: application/x-yaml');
        echo $openapi->toYaml();
        exit;
    }

    public function generateSwagger()
    {
        $openapi = Generator::scan([app_path('Http/Controllers'), app_path('Models')]);
        return response()->json($openapi);
    }
}
