<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\RegistrationCost;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Helpers\ActivityLog;
use Barryvdh\DomPDF\Facade as PDF;

class RegistrationCostController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data       = RegistrationCost::with('santris')->latest()->paginate(10);
        $keyword    = $request->keyword;
        if ($keyword)
            $data   = RegistrationCost::whereHas('santris', function ($query) use ($keyword) {
                return $query->where('name', 'LIKE', "%$keyword%")->orWhere('address', 'LIKE', "%$keyword%");
            })->latest()->paginate(10);

        return view('registration.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Santri::all();
        $cost = Cost::first();

        return view('registration.create', compact('data', 'cost'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RegistrationCost::create([
            'santri_id' => $request->santri_id,
            'construction' => $request->construction,
            'facilities' => $request->facilities,
            'wardrobe' => $request->wardrobe
        ]);

        ActivityLog::addToLog('Pembayaran Pendaftar Baru');
        return redirect()->route('registration.index')
            ->with('alert', 'Pembayaran Pendaftar Baru berhasil dilakukan.');    
    }

    public function print($id)
    {
      $data = RegistrationCost::with('santris')->findOrFail($id);
      $total = $data->construction + $data->facilities + $data->wardrobe;
      $pdf = PDF::loadView('registration.print', compact('data', 'total'))->setPaper('a4', 'portrait');

      return $pdf->stream('pembayaran_pendaftar_baru.pdf');
    }
}
