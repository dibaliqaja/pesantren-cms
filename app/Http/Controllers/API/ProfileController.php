<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use App\Helpers\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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
    public function show() {
        try {
            $user = User::with('santris')->find(auth()->id());

            return response()->json([
                'message' => 'Profile Query Get Success',
                'status'  => 'success',
                'data'    => $user->santris
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => null
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::with('santris')->find(auth()->id());
        $id = $user->santris->id;

        $validator = Validator::make($request->all(), [
            'name'                   => 'required|string|min:5',
            'address'                => 'required|string|min:5',
            'birth_place'            => 'required|string|min:5',
            'birth_date'             => 'required|date',
            'phone'                  => 'required|string|unique:santris,phone,'.$id,
            'school_old'             => 'required|string',
            'school_address_old'     => 'required|string',
            'school_current'         => 'required|string',
            'school_address_current' => 'required|string',
            'father_name'            => 'required|string',
            'mother_name'            => 'required|string',
            'father_job'             => 'required|string',
            'mother_job'             => 'required|string',
            'parent_phone'           => 'required|string',
            'entry_year'             => 'required|string|digits:4',
            'year_out'               => 'string|digits:4',
        ]);

        try {
            if ($validator->fails()) {
                return response()->json([
                    'message'       => 'Validation Error',
                    'status'        => 'error',
                    'data'          => $validator->errors(),
                ], 400);
            }

            $data = $request->all();
            $santri = Santri::findOrFail($id);
            $santri->update($data);

            $response = [
                'message'       => 'Data Santri Update Successfully',
                'status'        => 'success',
                'data'          => $santri,
            ];

            ActivityLog::addToLog('Profile Santri Updated');

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => null
            ]);
        }
    }
}
