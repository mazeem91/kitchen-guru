<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(version="1.0.0",title="Kitchen Guru OpenApi Demo Documentation")
 * @OA\Server(url=L5_SWAGGER_CONST_HOST,description="Demo API Server")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
    * @OA\Post(path="/sanctum/token", tags={"User"}, operationId="TokenGenerate", summary="Generate JWT for user",
    *   @OA\RequestBody(
    *       required=true,
    *       description="The Token Request",
    *       @OA\JsonContent(
    *        @OA\Property(property="email",type="string",example="test@example.com"),
    *        @OA\Property(property="password",type="string",example="password"),
    *        @OA\Property(property="device_name",type="string",example="phone"),
    *       )
    *   ),
    *   @OA\Response(
    *     response=200,
    *     description="OK"
    *   )
    * )
    */
    public function generateToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
