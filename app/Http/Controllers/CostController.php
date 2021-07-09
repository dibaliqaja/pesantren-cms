<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLog;
use App\Models\Cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CostController extends Controller
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
    public function index()
    {
        $data = Cost::first();
        
        return view('cost.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (auth()->user()->role == 'Pengurus') {
            return redirect()->back();
        }
        $data = Cost::first();

        return view('cost.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (auth()->user()->role == 'Pengurus') {
            return redirect()->back();
        }
        
        $this->validate($request, [
            'spp' => 'required|numeric|min:0',
            'construction' => 'required|numeric|min:1',
            'facilities' => 'required|numeric|min:1',
            'wardrobe' => 'required|numeric|min:1'
        ]);
               
        $cost = Cost::first();
        $cost->update($request->all());

        ActivityLog::addToLog('Cost Updated');
        return redirect()->route('biaya.index')
            ->with('alert', 'Biaya Pembayaran berhasil diupdate.');
    }
}
