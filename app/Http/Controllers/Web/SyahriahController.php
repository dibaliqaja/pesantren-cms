<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\CashBook;
use App\Models\Cost;
use App\Models\Santri;
use App\Models\Syahriah;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SyahriahController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now  = (int) date('Y');
        $data = Santri::with('syahriahs')->get();
        $year = $request->year;
        if ($year) $now = $year;

        $syahriahs = Syahriah::with('santris')->latest()->paginate(10);    
        $keyword = $request->keyword;
        if ($keyword) 
            $syahriahs = Syahriah::with('santris')
                    ->where('date', 'LIKE', "%$keyword%")
                    ->orWhere('month', 'LIKE', "%$keyword%")
                    ->orWhere('year', 'LIKE', "%$keyword%")
                    ->orWhereHas('santris', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%$keyword%");
                    })
                    ->latest()
                    ->paginate(10);

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

        $exist = Syahriah::where('santri_id', $request->santri_id)
                ->where('month', $request->month)
                ->where('year', $request->year)
                ->exists();

        if ($exist) {
            return redirect()->back()
                ->with('error', 'Syahriah (SPP) sudah dibayar.');
        }

        $syahriah = Syahriah::create([
            'date'      => now(),
            'month'     => $request->month,
            'year'      => $request->year,
            'santri_id' => $request->santri_id,
            'spp'       => $request->spp
        ]);

        $santri = Syahriah::with('santris')
                ->where('santri_id', $request->santri_id)
                ->first();

        CashBook::create([
            'date' => now(),
            'note' => 'Pembayaran Syahriah/SPP ' . $santri->santris->name,
            'debit' => $request->spp,
            'syahriah_id' => $syahriah->id
        ]);
        
        LogActivity::addToLog('Bayar Syahriah (SPP) ' . $santri->santris->name . ' ('. $request->month . ' ' . $request->year .')');
        return redirect()->route('syahriah.index')
            ->with('alert', 'Pembayaran Syahriah (SPP) berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('admin')) {
            $syahriah = Syahriah::with('santris')->findOrFail($id);
            $syahriah->delete();
    
            LogActivity::addToLog('Hapus Data Pembayaran Syahriah/SPP Santri');
            return redirect()->route('syahriah.index')
                ->with('alert','Data Syahriah berhasil dihapus.');
        }
        abort(403);
    }

    public function print($id)
    {
      $data = Syahriah::with('santris')->findOrFail($id);
      $total = $data->spp;
      $pdf = PDF::loadView('syahriah.print', compact('data', 'total'))->setPaper('a4', 'portrait');

      return $pdf->stream('bukti_pembayaran_syahriah.pdf');
    }
}
