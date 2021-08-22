<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CashBook;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashBookController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $balance   = DB::table('cash_books')->sum(DB::raw('debit - credit'));  
            $per_page  = $request->per_page ? $request->per_page : 10;
            $page      = $request->page ? $request->page : 1;
            $search    = $request->search;
            $cash_book = CashBook::query();
            $data      = $search
                            ? $cash_book->where('date', 'LIKE', "%$search%")
                                ->orWhere('note', 'LIKE', "%$search%")
                                ->orWhere('debit', 'LIKE', "%$search%")
                                ->orWhere('credit', 'LIKE', "%$search%")
                                ->orderBy('date', 'DESC')
                                ->orderBy('created_at', 'DESC')
                                ->paginate($per_page)
                            : $cash_book->orderBy('date', 'DESC')->orderBy('created_at', 'DESC')->paginate($per_page);

            $response = [
                'status'     => 'success',
                'message'    => 'Cash Book query get success',
                'saldo'      => $balance,
                'data'       => $data->items(),
                'page'       => $page,
                'per_page'   => $per_page,
                'total_data' => $data->total(),
                'total_page' => ceil($data->total() / $per_page)
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
