<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NotesController extends Controller
{
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
                'tanggal' => $request->tanggal,
                'masalah' => $request->masalah,
                'penanganan' => $request->penanganan,
                'foto' => $image->hashName(),
            ]);
        } else {
            $note->create([
                'siswa_id' => $request->siswa_id,
                'tanggal' => $request->tanggal,
                'masalah' => $request->masalah,
                'penanganan' => $request->penanganan,
            ]);
        }

        return redirect()->back()->with(['success' => 'Data Berhasil dibuat']);
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
    public function update(Request $request, $id)
    {
        //
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
