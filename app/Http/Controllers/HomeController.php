<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $this->middleware(function($request, $next){
            if(Gate::allows('admin')) return $next($request);

            abort(403, 'Sorry, you are not allowed to access this page');
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $santri     = DB::table('santris')->count();
        $in_mail    = DB::table('in_mails')->count();
        $out_mail   = DB::table('out_mails')->count();
        $cash_book  = DB::table('cash_books')->count();
        $debit      = DB::table('cash_books')->sum(DB::raw('debit'));
        $credit     = DB::table('cash_books')->sum(DB::raw('credit'));
        $balance    = DB::table('cash_books')->sum(DB::raw('debit - credit'));
        
        return view('home', compact(
            'in_mail',
            'out_mail',
            'cash_book',
            'santri',
            'debit',
            'credit',
            'balance'
        ));
    }
}
