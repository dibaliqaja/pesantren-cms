<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\User;
use App\Models\InMail;
use App\Models\OutMail;
use App\Models\CashBook;
use Illuminate\Support\Facades\DB;

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
     * @param  App\Models\Santri    $santri
     * @param  App\Models\User      $user
     * @param  App\Models\InMail    $inMail
     * @param  App\Models\OutMail   $outMail
     * @param  App\Models\CashBook  $cashBook
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function index(Santri $santri, User $user, InMail $inMail, OutMail $outMail, CashBook $cashBook)
    {
        $santri   = $santri->count();
        $users    = $user->count();
        $in_mail  = $inMail->count();
        $out_mail = $outMail->count();
        $debit    = $cashBook->sum('debit');
        $credit   = $cashBook->sum('credit');
        $balance  = $cashBook->sum(DB::raw('debit - credit'));
        
        return view('home', compact(
            'santri',
            'users',
            'debit',
            'credit',
            'balance',
            'in_mail',
            'out_mail'
        ));
    }
}
