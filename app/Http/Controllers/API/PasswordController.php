<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;

use App\Helpers\ActivityLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class PasswordController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'current_password'      => 'required|string|min:8',
            'password'              => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password'
        ]);
        
        try {
            if ($validator->fails()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validation Error',
                    'data'    => $validator->errors(),
                ], 400);
            }

            $plainPassword = $request->get('current_password');

            if (Hash::check($plainPassword, $user->password) == true) {
                $user->password = bcrypt(request('password'));
                $user->save();

                ActivityLog::addToLog('Change Password');

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Password updated successfully'
                ], 200);
            }

            return response()->json([
                'status'  => 'error',
                'message' => 'Old Password wrong'
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
