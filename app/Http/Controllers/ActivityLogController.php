<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ActivityLogController extends Controller
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
    
    public function index()
    {
        $data = DB::table('activity_logs')
                ->select('activity_logs.subject as subject', 'activity_logs.url as url', 'activity_logs.created_at as created_at', 'users.email as email', 'santris.name as name')
                ->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
                ->leftJoin('santris', 'santris.id', '=', 'users.santri_id')
                ->orderBy('activity_logs.created_at', 'DESC')->paginate(10);

        return view('activity-log', compact('data'));
    }
}
