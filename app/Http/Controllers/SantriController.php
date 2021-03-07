<?php

namespace App\Http\Controllers;

use App\Http\Requests\SantriRequest;
use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data       = Santri::latest()->paginate(10);
        $keyword    = $request->keyword;
        if ($keyword)
            $data   = Santri::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate(10);

        return view('santri.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $year = date('Y');
        // $new_year = substr($year, -2);
        // $data_santri = Santri::count();
        // dd($data_santri+5);
        // $nis = $new_year.$new_year+1..'.000'.$data_santri+1;
        return view('santri.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SantriRequest $request)
    {
        $santri = new Santri;
        $santri->create($request->validated());

        return redirect()->route('santri.index')
            ->with('alert', 'Santri baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('santri.show', ['santri' => Santri::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('santri.edit', ['santri' => Santri::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SantriRequest $request, $id)
    {
        $santri = Santri::findOrFail($id);
        $santri->update($request->validated());

        return redirect()->route('santri.index')
            ->with('alert', 'Santri berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();

        return redirect()->route('santri.index')
            ->with('alert','Data Santri berhasil dihapus.');
    }
}
