<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLog;
use App\Http\Requests\SantriRequest;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class SantriController extends Controller
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
            $file = $request->photo;
            $input['photo'] = 'santri-'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/photo');

            File::exists($destinationPath) or File::makeDirectory($destinationPath);

            $destinationPath = public_path('storage/photo');
            $file->move($destinationPath, $input['photo']);
            $validatedData             = $request->validated();
            $validatedData['photo']  = $input['photo'];
            $santri->create($validatedData);
        } else {
            $validatedData             = $request->validated();
            $santri->create($validatedData);
        }

        ActivityLog::addToLog('Santri Added');
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

        if ($request->hasFile('photo')) {
            $filePath = public_path('storage/photo/'.$santri->photo);
            if(File::exists($filePath)) File::delete($filePath);

            $file = $request->photo;
            $input['photo'] = 'santri-'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/photo');
            File::exists($destinationPath) or File::makeDirectory($destinationPath);
            $file->move($destinationPath, $input['photo']);
            $validatedData           = $request->validated();
            $validatedData['photo']  = $input['photo'];
            $santri->update($validatedData);
        } else {
            $validatedData           = $request->validated();
            $santri->update($validatedData);
        }

        ActivityLog::addToLog('Santri Updated');
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
        $user_exist = User::where('santri_id', $santri->id)->exists();

        if ($user_exist) {
            return redirect()->back()->with('alert','Data Santri masih berelasi dengan salah satu data pengguna.');
        }

        $filePath = public_path('storage/photo/'.$santri->photo);
        if(File::exists($filePath)) File::delete($filePath);
        $santri->delete();

        ActivityLog::addToLog('Santri Deleted');
        return redirect()->route('santri.index')
            ->with('alert','Data Santri berhasil dihapus.');
    }
}
