<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
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

        return redirect()->route('pengguna.index')
            ->with('alert', 'Pengguna baru berhasil ditambahkan.');
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
        $data = Santri::all();
        $user = $user = User::findOrFail($id);
        return view('user.edit', compact('user', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'santri_id' => 'required|exists:santris,id|unique:users,santri_id,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'required|string|confirmed|min:8',
            'role'  => 'required|in:Administrator,Pengurus,Santri'
        ]);

        $user = User::findOrFail($id);
        $validatedData              = $request->all();
        $validatedData['password']  = Hash::make($request->password);
        $user->update($validatedData);

        return redirect()->route('pengguna.index')
            ->with('alert', 'Pengguna berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengguna.index')
            ->with('alert','Pengguna berhasil dihapus.');
    }
}
