<?php

namespace App\Http\Controllers;

use App\Models\LogNote;
use App\Models\Note;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NotesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:note-list|note-create|note-edit|note-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:note-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:note-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:note-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $siswa = Siswa::findOrFail($id);
        return view('notes.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Note $note)
    {
        //
        $this->validate($request, [
            'tanggal' => 'required|date',
            'masalah' => 'required|min:2',
            'penanganan' => 'nullable',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $image->storeAs('public/lampiranNote', $image->hashName());

            $note->create([
                'siswa_id' => $request->siswa_id,
                'user_id' => Auth::user()->id,
                'tanggal' => $request->tanggal,
                'masalah' => $request->masalah,
                'penanganan' => $request->penanganan,
                'foto' => $image->hashName(),
            ]);
        } else {
            $note->create([
                'siswa_id' => $request->siswa_id,
                'user_id' => Auth::user()->id,
                'tanggal' => $request->tanggal,
                'masalah' => $request->masalah,
                'penanganan' => $request->penanganan,
            ]);
        }

        // log notes
        $log = new LogNote();
        $log->user_id = Auth::user()->id;
        $log->siswa_id = $request->siswa_id;
        $log->method = 'Membuat Notes Baru';
        $log->save();

        return redirect()->back()->with(['success' => 'Data Berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $note)
    {
        //
        $siswa = Siswa::findOrFail($id);
        $note = Note::findOrFail($note);
        // dd($note);
        return view('notes.show', compact('siswa', 'note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $note)
    {
        //
        $siswa = Siswa::findOrFail($id);
        $note = Note::findOrFail($note);
        return view('notes.edit', compact('siswa', 'note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $note)
    {
        //
        $this->validate($request, [
            'tanggal' => 'required|date',
            'masalah' => 'required|min:2',
            'penanganan' => 'nullable',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
        ]);

        $siswa = Siswa::findOrFail($id);
        $note = Note::findOrFail($note);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $image->storeAs('public/lampiranNote', $image->hashName());
            Storage::delete('public/lampiranNote/' . $note->foto);

            $note->update([
                'tanggal' => $request->tanggal,
                'masalah' => $request->masalah,
                'penanganan' => $request->penanganan,
                'foto' => $image->hashName(),
            ]);
        } else {
            $note->update([
                'tanggal' => $request->tanggal,
                'masalah' => $request->masalah,
                'penanganan' => $request->penanganan,
            ]);
        }

        // log notes
        $log = new LogNote();
        $log->user_id = Auth::user()->id;
        $log->siswa_id = $request->siswa_id;
        $log->method = 'Perbarui Data Notes';
        $log->save();

        return redirect()->back()->with(['success' => 'Data Berhasil diupdate']);
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
