<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

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
        try {
            $user = $request->user();

            $request->validate([
                'current_password'      => 'required',
                'password'              => 'required',
                'password_confirmation' => 'required|same:password'
            ]);

            $plainPassword = $request->get('current_password');

            if (Hash::check($plainPassword, $user->password) == true) {
                $user->password = bcrypt(request('password'));
                $user->save();

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Password updated successfully'
                ]);
            }

            return response()->json([
                'status'  => 'error',
                'message' => 'Old Password wrong'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Not Found',
                'data'    => null
            ]);
        }
    }
}
