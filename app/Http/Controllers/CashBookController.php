<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashBookRequest;
use App\Models\CashBook;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
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
        if ($request->ajax()) {
            $data = CashBook::orderBy('date', 'DESC')->orderBy('created_at', 'DESC');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCash"><i class="fas fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('cash-book.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'      => 'required|date',
            'note'      => 'required|string',
            'debit'     => 'required|number',
            'credit'    => 'required|number'
        ]);

        $total = CashBook::latest()->first();
        // $total = $total == null ? $total['total'] = 0 : $total;

        if ($request->credit == null) {
            $data = CashBook::create([
                'date' => $request->date,
                'note' => $request->note,
                'debit' => $request->debit,
                'credit' => $request->credit,
                'total' => $total['total']+$request->debit
            ]);
        } else if ($request->debit == null) {
            $data = CashBook::create([
                'date' => $request->date,
                'note' => $request->note,
                'debit' => $request->debit,
                'credit' => $request->credit,
                'total' => $total['total']-$request->credit
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Request debit or credit isNull',
                'data' => null
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data input successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CashBook::findOrFail($id)->delete();
    }
}
