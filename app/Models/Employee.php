<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

/**
 * @OA\Schema(
 *     schema="Employee",
 *     type="object",
 *     title="Employee",
 *     description="Employee model",
 *     required={"first_name", "last_name", "email", "phone_number"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the employee"
 *     ),
 *     @OA\Property(
 *         property="first_name",
 *         type="string",
 *         description="First name of the employee"
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         description="Last name of the employee"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Email address of the employee"
 *     ),
 *     @OA\Property(
 *         property="phone_number",
 *         type="string",
 *         description="Phone number of the employee"
 *     )
 * )
 */
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
    ];
}
