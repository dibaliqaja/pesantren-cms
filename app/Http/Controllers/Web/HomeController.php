<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $santris    = DB::table('santris')->count();
        $users      = DB::table('users')->count();
        $in_mail    = DB::table('in_mails')->count();
        $out_mail   = DB::table('out_mails')->count();
        $debit      = DB::table('cash_books')->sum(DB::raw('debit'));
        $credit     = DB::table('cash_books')->sum(DB::raw('credit'));
        $balance    = DB::table('cash_books')->sum(DB::raw('debit - credit'));
        
        return view('home', compact(
            'santris',
            'users',
            'debit',
            'credit',
            'balance',
            'in_mail',
            'out_mail'
        ));
    }
}
