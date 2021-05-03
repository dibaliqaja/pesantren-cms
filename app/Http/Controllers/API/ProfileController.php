<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\SantriRequest;
use App\Models\Santri;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        try {
            $user = User::with('santris')->find(auth()->id());

            return response()->json([
                'status'  => 'success',
                'data'    => $user->santris
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => $th
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(SantriRequest $request)
    {
        $user = User::with('santris')->find(auth()->id());
        $id = $user->santris->id;

        try {
            if ($request->validator->fails()) {
                return response()->json([
                    'message'       => 'Validation Error',
                    'status'        => 'error',
                    'data'          => $request->validator->errors(),
                ], 400);
            }

            $data = $request->validated();
            $santri = Santri::findOrFail($id);

            $santri->update($data);

            $response = [
                'message'       => 'Data Santri Update Successfully',
                'status'        => 'success',
                'data'          => $santri,
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => $th
            ]);
        }
    }
}
