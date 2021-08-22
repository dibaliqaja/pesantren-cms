<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application log activites.
     *
     */
    public function index(Request $request)
    {
        $data = LogActivity::with('users')->latest()->paginate(10);
        $keyword = $request->keyword;
        if ($keyword)
            $data = LogActivity::with('users')
                ->where('subject', 'LIKE', "%$keyword%")
                ->orWhere('url', 'LIKE', "%$keyword%")
                ->orWhereHas('users', function ($query) use ($keyword) {
                    $query->where('email', 'LIKE', "%$keyword%");
                })
                ->orWhereHas('users.santris', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                })
                ->latest()
                ->paginate(10);
        
        return view('log-activities', compact('data'));
    }
}
