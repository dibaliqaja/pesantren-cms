<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Syahriah;
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

        // $year    = $request->year;
        // $keyword = $request->keyword ? $request->keyword : '';

        // if ($year) {
        //     $now = $year;
        //     $data = Santri::with('syahriahs')->whereHas('syahriahs', function($q) use ($year) {
        //         $q->where('year', $year);
        //     })->get();
        //     dd($data);
        // }

        // if ($year) {
        //     $books = Book::with('categories')->where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        // } else {
        //     $books = Book::with('categories')->where('title', "LIKE", "%$keyword%")->paginate(10);
        // }

        // $data       = User::with('santris')->latest()->paginate(10);
        // $keyword    = $request->keyword;
        // if ($keyword)
        //     $data   = User::with('santris')
        //         ->where('email', 'LIKE', "%$keyword%")
        //         ->orWhere('role', 'LIKE', "%$keyword%")
        //         ->orWhereHas('santris', function ($query) use ($keyword) {
        //             $query->where('name', 'LIKE', "%$keyword%");
        //         })
        //         ->latest()
        //         ->paginate(10);

        return view('syahriah.index', compact('now', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Syahriah::create([
        //     'date'      => now(),
        //     'month'     => $request->month,
        //     'year'      => $request->year,
        //     'pay'       => 1,
        //     'santri_id' => $request->santri_id,
        // ]);

        // return redirect()->route('syahriah.index')
        //     ->with('alert', 'Syahriah berhasil dibayar.');
    }
}
