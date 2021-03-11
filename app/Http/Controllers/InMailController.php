<?php

namespace App\Http\Controllers;

use App\Http\Requests\InMailRequest;
use App\Models\InMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class InMailController extends Controller
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
        $data       = InMail::latest()->paginate(10);
        $keyword    = $request->keyword;
        if ($keyword)
            $data   = InMail::where('mail_number', 'LIKE', "%$keyword%")
                ->orWhere('mail_date', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->orWhere('sender', 'LIKE', "%$keyword%")
                ->orWhere('recipient', 'LIKE', "%$keyword%")
                ->latest()
                ->paginate(10);

        return view('in-mail.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('in-mail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InMailRequest $request)
    {
        $inmail = new InMail;

        if ($request->hasFile('file_in')) {
            $file = $request->file_in;
            $input['file_in'] = 'inmail-'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/in-mail');

            File::exists($destinationPath) or File::makeDirectory($destinationPath);

            $destinationPath = public_path('storage/in-mail');
            $file->move($destinationPath, $input['file_in']);
            $validatedData             = $request->validated();
            $validatedData['file_in']  = $input['file_in'];
            $inmail->create($validatedData);
        } else {
            $validatedData             = $request->validated();
            $inmail->create($validatedData);
        }

        return redirect()->route('surat-masuk.index')
            ->with('alert', 'Surat Masuk baru berhasil ditambahkan.');
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
        return view('in-mail.edit', ['inmail' => InMail::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InMailRequest $request, $id)
    {
        $inmail = InMail::findOrFail($id);

        if ($request->hasFile('file_in')) {
            $filePath = public_path('storage/in-mail/'.$inmail->file_in);
            if(File::exists($filePath)) File::delete($filePath);

            $file = $request->file_in;
            $input['file_in'] = 'inmail-'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/in-mail');
            File::exists($destinationPath) or File::makeDirectory($destinationPath);
            $file->move($destinationPath, $input['file_in']);
            $validatedData             = $request->validated();
            $validatedData['file_in']  = $input['file_in'];
            $inmail->update($validatedData);
        } else {
            $validatedData             = $request->validated();
            $inmail->update($validatedData);
        }

        return redirect()->route('surat-masuk.index')
            ->with('alert', 'Surat Masuk berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inmail = InMail::findOrFail($id);
        $filePath = public_path('storage/in-mail/'.$inmail->file_in);
        if(File::exists($filePath)) File::delete($filePath);
        $inmail->delete();

        return redirect()->route('surat-masuk.index')
            ->with('alert','Data Surat Masuk berhasil dihapus.');
    }
}
