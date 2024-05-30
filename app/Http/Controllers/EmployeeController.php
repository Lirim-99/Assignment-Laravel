<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
use App\Models\Employee;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class EmployeeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    #[OA\Get(
        path: '/api/employees',
        operationId: 'getEmployeesList',
        summary: 'Get all employees',
        tags: ['Employees'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'A list of employees',
                content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Employee'))
            ),
            new OA\Response(
                response: 400,
                description: 'Bad request'
            )
        ]
    )]
    public function index(Request $request)
    {
        $employees = Employee::all();

        if ($request->expectsJson()) {
            return response()->json($employees);
        }

        return view('welcome', compact('employees'));
    }


    /**
     * Store a newly created resource in storage.
     */
    #[OA\Post(
        path: '/api/employees',
        summary: 'Create a new employee',
        tags: ['Employees'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'first_name', type: 'string'),
                    new OA\Property(property: 'last_name', type: 'string'),
                    new OA\Property(property: 'email', type: 'string', format: 'email'),
                    new OA\Property(property: 'phone_number', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Employee created successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Employee')
            )
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone_number' => 'required'
        ]);
        $employee = Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    /**
     * Display the specified resource.
     */
    #[OA\Get(
        path: '/api/employees/{id}',
        summary: 'Get a specific employee',
        tags: ['Employees'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details of a specific employee',
                content: new OA\JsonContent(ref: '#/components/schemas/Employee')
            )
        ]
    )]
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return redirect()->route('employees.index');
    }

    // public function showSwagger(){
    //     $employee = Employee::findOrFail($id);
    //     return response()->json($employee);
    // }


    /**
     * Update the specified resource in storage.
     */
    #[OA\Put(
        path: '/api/employees/{id}',
        summary: 'Update an employee',
        tags: ['Employees'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'first_name', type: 'string'),
                    new OA\Property(property: 'last_name', type: 'string'),
                    new OA\Property(property: 'email', type: 'string', format: 'email'),
                    new OA\Property(property: 'phone_number', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Employee updated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/Employee')
            )
        ]
    )]
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone_number' => 'required'
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OA\Delete(
        path: '/api/employees/{id}',
        summary: 'Delete an employee',
        tags: ['Employees'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: 'Employee deleted successfully'
            )
        ]
    )]
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
