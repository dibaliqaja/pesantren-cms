<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\OutMailRequest;
use App\Models\OutMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class OutMailController extends Controller
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
        $data       = OutMail::latest()->paginate(10);
        $keyword    = $request->keyword;
        if ($keyword)
            $data   = OutMail::where('mail_number', 'LIKE', "%$keyword%")
                ->orWhere('mail_date', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->orWhere('sender', 'LIKE', "%$keyword%")
                ->orWhere('recipient', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate(10);

        return view('out-mail.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('out-mail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\OutMailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutMailRequest $request)
    {
        $outmail = new OutMail;

        if ($request->hasFile('file_out')) {
            $validatedData = $request->validated();
            $file = $request->file_out;
            $input['file_out'] = 'outmail-'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/out-mail');

            File::exists($destinationPath) or File::makeDirectory($destinationPath);

            $destinationPath = public_path('storage/out-mail');
            $file->move($destinationPath, $input['file_out']);
            $validatedData['file_out'] = $input['file_out'];
            $outmail->create($validatedData);
        } else {
            $validatedData = $request->validated();
            $outmail->create($validatedData);
        }

        LogActivity::addToLog('Tambah Surat Keluar');
        return redirect()->route('surat-keluar.index')
            ->with('alert', 'Surat Keluar berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('out-mail.edit', ['outmail' => OutMail::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\OutMailRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OutMailRequest $request, $id)
    {
        $outmail = OutMail::findOrFail($id);

        if ($request->hasFile('file_out')) {
            $validatedData = $request->validated();
            $filePath = public_path('storage/out-mail/'.$outmail->file_out);
            if(File::exists($filePath)) File::delete($filePath);

            $file = $request->file_out;
            $input['file_out'] = 'outmail-'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/out-mail');
            File::exists($destinationPath) or File::makeDirectory($destinationPath);
            $file->move($destinationPath, $input['file_out']);
            $validatedData['file_out'] = $input['file_out'];
            $outmail->update($validatedData);
        } else {
            $validatedData = $request->validated();
            $outmail->update($validatedData);
        }

        LogActivity::addToLog('Edit Surat Keluar');
        return redirect()->route('surat-keluar.index')
            ->with('alert', 'Surat Keluar berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('admin')) {
            $outmail = OutMail::findOrFail($id);
            $filePath = public_path('storage/out-mail/'.$outmail->file_out);
            if(File::exists($filePath)) File::delete($filePath);
            $outmail->delete();

            LogActivity::addToLog('Hapus Surat Keluar');
            return redirect()->route('surat-keluar.index')
                ->with('alert','Surat Keluar berhasil dihapus.');
        }
        abort(403);
    }
}
