<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $data       = User::with('santris')->latest()->paginate(10);
        $keyword    = $request->keyword;
        if ($keyword)
        $data   = User::with('santris')
                ->where('email', 'LIKE', "%$keyword%")
                ->orWhere('role', 'LIKE', "%$keyword%")
                ->orWhereHas('santris', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%");
                })
                ->latest()
                ->paginate(10);

        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Santri::all();
        return view('user.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User;
        $validatedData              = $request->validated();
        $validatedData['password']  = Hash::make($request->password);
        $user->create($validatedData);

        LogActivity::addToLog('Tambah Data Pengguna');
        return redirect()->route('pengguna.index')
            ->with('alert', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('admin')) {
            $data = Santri::all();
            $user = User::findOrFail($id);
            return view('user.edit', compact('user', 'data'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\UserRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if (Gate::allows('admin')) {
            $user = User::findOrFail($id);
            $validatedData = $request->all();
            $validatedData['password'] = Hash::make($request->password);
            $user->update($validatedData);
    
            LogActivity::addToLog('Edit Data Pengguna');
            return redirect()->route('pengguna.index')
                ->with('alert', 'Pengguna berhasil diupdate.');
        }
        abort(403);
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
            $user = User::findOrFail($id);

            if (auth()->user() == $user) {
                return redirect()->back()
                    ->with('alert','Gagal menghapus data sendiri.');
            }

            $user->delete();
    
            LogActivity::addToLog('Hapus Data Pengguna');
            return redirect()->route('pengguna.index')
                ->with('alert','Pengguna berhasil dihapus.');
        }
        abort(403);
    }
}
