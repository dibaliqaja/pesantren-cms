<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashBookRequest;
use App\Models\CashBook;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CashBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CashBook::latest();
            return DataTables::of($data)
                    ->addIndexColumn()
                    // ->addColumn('action', function($row){
                    //     $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editMajor"><i class="fas fa-pen"></i></a>';
                    //     $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteMajor"><i class="fas fa-trash"></i></a>';
                    //     return $btn;
                    // })
                    // ->rawColumns(['action'])
                    ->make(true);
        }

        return view('cash_book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashBookRequest $request)
    {
        $cash_book = new CashBook;
        $cash_book->create($request->validated());

        return redirect()->route('cash_book.index')
            ->with('alert', 'Data baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CashBookRequest $request, $id)
    {
        $cash_book = CashBook::findOrFail($id);
        $cash_book->update($request->validated());

        return redirect()->route('cash_book.index')
            ->with('alert', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
