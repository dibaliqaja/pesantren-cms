<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLog;
use App\Http\Requests\CashBookRequest;
use App\Models\CashBook;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
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
        $data       = CashBook::orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);
        $keyword    = $request->keyword;
        if ($keyword)
            $data   = CashBook::where('date', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->orWhere('debit', 'LIKE', "%$keyword%")
                ->orWhere('credit', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate(10);

        return view('cash-book.index', compact('data'));
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
            'debit' => 'required|numeric|min:0'
        ]);

        CashBook::create($request->all());

        ActivityLog::addToLog('Cash Debit Added');
        return redirect()->route('buku-kas.index')
            ->with('alert', 'Debit berhasil ditambahkan.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCredit()
    {
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
            'credit' => 'required|numeric|min:0'
        ]);

        CashBook::create($request->all());

        ActivityLog::addToLog('Cash Credit Added');
        return redirect()->route('buku-kas.index')
            ->with('alert', 'Kredit berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cash = CashBook::findOrFail($id);
        $cash->delete();

        ActivityLog::addToLog('Data Kas Deleted ('.$cash->note.')');
        return redirect()->route('buku-kas.index')
            ->with('alert','Data Kas berhasil dihapus.');
    }
}
