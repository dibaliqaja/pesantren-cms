<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => 'login']);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ], 422);
            }
    
            if (!$token = JWTAuth::attempt($validator->validated())) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }
    
            return $this->createNewToken($token);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => $th
            ]);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        try {            
            auth()->logout();

            return response()->json([
                'success' => true,
                'message' => 'User successfully signed out'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => $th
            ], 422);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        try {
            return $this->createNewToken(auth()->refresh());
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => $th
            ], 422);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
