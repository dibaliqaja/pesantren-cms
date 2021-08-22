<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\CashBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CashBookController extends Controller
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
        $data       = CashBook::orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);
        $balance    = DB::table('cash_books')->sum(DB::raw('debit - credit'));        
        $keyword    = $request->keyword;
        if ($keyword)
            $data   = CashBook::where('date', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->orWhere('debit', 'LIKE', "%$keyword%")
                ->orWhere('credit', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate(10);

        return view('cash-book.index', compact('data', 'balance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDebit()
    {
        return view('cash-book.debit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDebit(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'note' => 'required|string',
            'debit' => 'required|numeric|min:1'
        ]);

        CashBook::create($request->all());

        LogActivity::addToLog('Tambah Pemasukan Kas');
        return redirect()->route('buku-kas.index')
            ->with('alert', 'Pemasukan berhasil ditambahkan.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCredit()
    {
        $balance    = DB::table('cash_books')->sum(DB::raw('debit - credit'));
        if ($balance <= 0) {
            return redirect()->route('buku-kas.index')
                ->with('alert', 'Saldo tidak mencukupi.');
        }

        return view('cash-book.credit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCredit(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'note' => 'required|string',
            'credit' => 'required|numeric|min:1'
        ]);

        $balance    = DB::table('cash_books')->sum(DB::raw('debit - credit'));
        if ($request->credit > $balance) {
            return redirect()->route('buku-kas.index')
                ->with('alert', 'Saldo tidak mencukupi.');
        }

        CashBook::create($request->all());

        LogActivity::addToLog('Tambah Pengeluaran Kas');
        return redirect()->route('buku-kas.index')
            ->with('alert', 'Pengeluaran berhasil ditambahkan.');
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
            $cash = CashBook::findOrFail($id);
            $cash->delete();
    
            LogActivity::addToLog('Hapus Data Kas ('.$cash->note.')');
            return redirect()->route('buku-kas.index')
                ->with('alert','Data Kas berhasil dihapus.');
        }
        abort(403);
    }
}
