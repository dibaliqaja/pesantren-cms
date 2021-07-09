<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Santri;
use App\Models\Syahriah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Helpers\ActivityLog;
use App\Models\CashBook;
use Barryvdh\DomPDF\Facade as PDF;

class SyahriahController extends Controller
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
        $now  = (int) date('Y');
        $data = Santri::with('syahriahs')->get();
        $year = $request->year;
        $syahriahs = Syahriah::with('santris')->latest()->paginate(10);
        
        if ($year) $now = $year;

        return view('syahriah.index', compact('now', 'data', 'syahriahs'));
    }

    /**
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Santri::all();
        $cost = Cost::first();
        $now  = (int) date('Y');

        return view('syahriah.create', compact('data', 'cost', 'now'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'santri_id' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);

        if (Syahriah::where('santri_id', $request->santri_id)->where('month', $request->month)->where('year', $request->year)->exists()) {
            return redirect()->back()
                ->with('error', 'Syahriah sudah dibayar.');
        }

        Syahriah::create([
            'date'      => now(),
            'month'     => $request->month,
            'year'      => $request->year,
            'santri_id' => $request->santri_id,
            'spp'       => $request->spp
        ]);

        $santri = Syahriah::with('santris')->where('santri_id', $request->santri_id)->first();

        CashBook::create([
            'date' => now(),
            'note' => 'Pembayaran Syahriah ' . $santri->santris->name . ' ('. $santri->month . $santri->year .')',
            'debit' => $request->spp
        ]);

        ActivityLog::addToLog('Pembayaran Syahriah ' . $santri->santris->name . ' ('. $santri->month . $santri->year .')');
        return redirect()->route('syahriah.index')
            ->with('alert', 'Syahriah berhasil dibayar.');
    }

    public function print($id)
    {
      $data = Syahriah::with('santris')->findOrFail($id);
      $total = $data->spp;
      $pdf = PDF::loadView('syahriah.print', compact('data', 'total'))->setPaper('a4', 'portrait');

      return $pdf->stream('syahriah.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $syahriah = Syahriah::with('santris')->findOrFail($id);
        $cash_book = CashBook::where('date', $syahriah->date)->where('note', 'Pembayaran Syahriah ' . $syahriah->santris->name . ' ('. $syahriah->month . $syahriah->year .')')->first();
        $cash_book->delete();
        $syahriah->delete();

        ActivityLog::addToLog('Syahriah Deleted');
        return redirect()->route('syahriah.index')
            ->with('alert','Data Syahriah berhasil dihapus.');
    }
}
