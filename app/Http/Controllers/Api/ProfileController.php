<?php

namespace App\Http\Controllers\Api;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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
            $profile = User::with('santris')->find(auth()->id());
            
            tap($profile, function($profile) {
                if ($profile->santris->photo !== null) {
                    $profile->santris->photo = asset('storage/photo/' . $profile->santris->photo);
                    return $profile;
                } else {
                    $profile->santris->photo = null;
                    return $profile;
                }
            });

            $data = [
                'email' => $profile->email,
                'role'  => $profile->role,
                'santri_id' => $profile->santris->id,
                'name' => $profile->santris->name,
                'address' => $profile->santris->address,
                'birth_place' => $profile->santris->birth_place,
                'birth_date' => $profile->santris->birth_date,
                'phone' => $profile->santris->phone,
                'school_old' => $profile->santris->school_old,
                'school_address_old' => $profile->santris->school_address_old,
                'school_current' => $profile->santris->school_current,
                'school_address_current' => $profile->santris->school_address_current,
                'father_name' => $profile->santris->father_name,
                'mother_name' => $profile->santris->mother_name,
                'father_job' => $profile->santris->father_job,
                'mother_job' => $profile->santris->mother_job,
                'parent_phone' => $profile->santris->parent_phone,
                'entry_year' => $profile->santris->entry_year,
                'year_out' => $profile->santris->year_out,
                'photo' => $profile->santris->photo
            ];

            return response()->json([
                'status'  => 'success',
                'message' => 'Profile query get success',
                'data'    => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
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
        $id_user = $user->id;

        $validator = Validator::make($request->all(), [
            'email'                  => 'required|string|email|max:255|unique:users,email,'.$id_user,
            'name'                   => 'required|string|min:5',
            'address'                => 'required|string|min:5',
            'birth_place'            => 'required|string|min:5',
            'birth_date'             => 'required|date',
            'phone'                  => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:santris,phone,'.$id,
            'school_old'             => 'required|string',
            'school_address_old'     => 'required|string',
            'school_current'         => 'required|string',
            'school_address_current' => 'required|string',
            'father_name'            => 'required|string',
            'mother_name'            => 'required|string',
            'father_job'             => 'required|string',
            'mother_job'             => 'required|string',
            'parent_phone'           => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:santris,parent_phone,'.$id,
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

            $data = [
                'name'                   => $request->name,
                'address'                => $request->address,
                'birth_place'            => $request->birth_place,
                'birth_date'             => $request->birth_date,
                'phone'                  => $request->phone,
                'school_old'             => $request->school_old,
                'school_address_old'     => $request->school_address_old,
                'school_current'         => $request->school_current,
                'school_address_current' => $request->school_address_current,
                'father_name'            => $request->father_name,
                'mother_name'            => $request->mother_name,
                'father_job'             => $request->father_job,
                'mother_job'             => $request->mother_job,
                'parent_phone'           => $request->parent_phone,
                'entry_year'             => $request->entry_year,
                'year_out'               => $request->year_out
            ];

            $santri = Santri::findOrFail($id);
            $user = User::findOrFail($id_user);

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
                $user->update(['email' => $request->email]);
            } else {
                $santri->update($data);
                $user->update(['email' => $request->email]);
            }

            tap($santri, function($santri) {
                $santri->entry_year = (int)$santri->entry_year;
                $santri->year_out = (int)$santri->year_out;
                if ($santri->photo !== null) {                        
                    $santri->photo = asset('storage/photo/' . $santri->photo);
                    return $santri;
                } else {
                    $santri->photo = null;
                    return $santri;
                }
            });

            $data = [
                'email' => $user->email,
                'role'  => $user->role,
                'santri_id' => $santri->id,
                'name' => $santri->name,
                'address' => $santri->address,
                'birth_place' => $santri->birth_place,
                'birth_date' => $santri->birth_date,
                'phone' => $santri->phone,
                'school_old' => $santri->school_old,
                'school_address_old' => $santri->school_address_old,
                'school_current' => $santri->school_current,
                'school_address_current' => $santri->school_address_current,
                'father_name' => $santri->father_name,
                'mother_name' => $santri->mother_name,
                'father_job' => $santri->father_job,
                'mother_job' => $santri->mother_job,
                'parent_phone' => $santri->parent_phone,
                'entry_year' => $santri->entry_year,
                'year_out' => $santri->year_out,
                'photo' => $santri->photo
            ];

            $response = [
                'status'  => 'success',
                'message' => 'Data santri update successfully',
                'data'    => $data,
            ];

            LogActivity::addToLog('Update Profil');
            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
