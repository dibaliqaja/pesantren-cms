<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use App\Helpers\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\File;
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
                'status'  => 'success',
                'message' => 'Profile query get success',
                'data'    => $user->santris
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Not Found',
                'data'    => null
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
            'parent_phone'           => 'required|string|unique:santris,parent_phone,'.$id,
            'entry_year'             => 'required|digits:4',
            'year_out'               => 'nullable|digits:4',
            'photo'                  => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            if ($validator->fails()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Validation Error',
                    'data'    => $validator->errors(),
                ], 400);
            }

            $data = $request->all();
            $santri = Santri::findOrFail($id);

            if ($request->hasFile('photo')) {
                $filePath = public_path('storage/photo/'.$santri->photo);
                if(File::exists($filePath)) File::delete($filePath);
    
                $file = $request->photo;
                $input['photo'] = 'santri-'.time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('storage/photo');
                File::exists($destinationPath) or File::makeDirectory($destinationPath);
                $file->move($destinationPath, $input['photo']);
                $data['photo']  = $input['photo'];
                $santri->update($data);
            } else {
                $santri->update($data);
            }

            $santri->update($data);

            $response = [
                'status'  => 'success',
                'message' => 'Data santri update successfully',
                'data'    => $santri,
            ];

            ActivityLog::addToLog('Profile Santri Updated');

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Not Found',
                'data'    => null
            ]);
        }
    }
}
