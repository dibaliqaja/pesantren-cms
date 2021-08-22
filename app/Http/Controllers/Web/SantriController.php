<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\SantriRequest;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class SantriController extends Controller
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

        if ($request->hasFile('photo')) {
            $validatedData = $request->validated();
            $file = $request->photo;
            $input['photo'] = 'santri-'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/photo');

            File::exists($destinationPath) or File::makeDirectory($destinationPath);

            $destinationPath = public_path('storage/photo');
            $file->move($destinationPath, $input['photo']);
            $validatedData['photo'] = $input['photo'];
            $santri->create($validatedData);
        } else {
            $validatedData = $request->validated();
            $santri->create($validatedData);
        }

        LogActivity::addToLog('Tambah Data Santri');
        return redirect()->route('santri.index')
            ->with('alert', 'Santri baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('santri.show', ['santri' => Santri::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
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
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(SantriRequest $request, $id)
    {
        $santri = Santri::findOrFail($id);

        if ($request->hasFile('photo')) {
            $validatedData = $request->validated();
            $filePath = public_path('storage/photo/'.$santri->photo);
            if(File::exists($filePath)) File::delete($filePath);

            $file = $request->photo;
            $input['photo'] = 'santri-'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/photo');
            File::exists($destinationPath) or File::makeDirectory($destinationPath);
            $file->move($destinationPath, $input['photo']);
            $validatedData['photo']  = $input['photo'];
            $santri->update($validatedData);
        } else {
            $validatedData = $request->validated();
            $santri->update($validatedData);
        }

        LogActivity::addToLog('Edit Data Santri');
        return redirect()->route('santri.index')
            ->with('alert', 'Santri berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('admin')) {
            $santri = Santri::findOrFail($id);
            $user = User::where('santri_id', $id)->first();
           
            if (auth()->user() == $user) {
                return redirect()->back()
                    ->with('alert','Gagal menghapus data sendiri.');
            }

            $filePath = public_path('storage/photo/'.$santri->photo);
            if(File::exists($filePath)) File::delete($filePath);
            $santri->delete();

            LogActivity::addToLog('Hapus Data Santri');
            return redirect()->route('santri.index')
                ->with('alert','Data Santri berhasil dihapus.');
        }
        
        abort(403);
    }
}
