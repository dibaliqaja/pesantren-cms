<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('admin')) return $next($request);

            abort(403, 'Sorry, you are not allowed to access this page');
        });
    }
    
    public function change(Request $request)
    {
        return view('password', [
            'user' => $request->user()
        ]);
    }

    public function update(Request $request)
    {
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

            ActivityLog::addToLog('Change Password');
            return redirect()->back()->with('success','Password updated successfully.');
        }

        return redirect()->back()->with('error','Old Password Wrong!');

    }
}
