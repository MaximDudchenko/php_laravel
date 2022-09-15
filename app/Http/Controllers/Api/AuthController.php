<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\AuthRequest as AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(AuthRequest $request)
    {
        $fields = $request->validated();

        if (!auth()->attempt($fields)) {
            return response()->json([
                'status' => 'error',
                'data' => [
                    'message' => 'User not found'
                ]
            ]);
        }

        return auth()->user()->createToken($request->device_name ?? 'api')->plainTextToken;
    }

}
