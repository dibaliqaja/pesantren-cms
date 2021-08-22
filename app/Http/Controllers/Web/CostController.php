<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\CostRequest;
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
        $this->middleware('auth');
    }

    /**
     * Display a cost.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        if (Gate::allows('admin')) {
            $data = Cost::first();
    
            return view('cost.edit', compact('data'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(CostRequest $request)
    {
        if (Gate::allows('admin')) {
            $cost = Cost::first();
            $cost->update($request->validated());

            LogActivity::addToLog('Edit Biaya Pembayaran');
            return redirect()->route('biaya.index')
                ->with('alert', 'Biaya Pembayaran berhasil diupdate.');
        }
        abort(403);
    }
}
