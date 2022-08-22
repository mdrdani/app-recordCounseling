<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $siswas = Siswa::latest()->paginate(10);
        return view('siswa.index', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|min:2|string',
            'nis' => 'nullable|min:2|numeric|unique:siswas,nis',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'nullable',
            'kelas_id' => 'required'
        ]);

        $siswa = new Siswa;
        $siswa->id = $request->id;
        $siswa->name = $request->name;
        $siswa->nis = $request->nis;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->save();

        return redirect()->route('siswas.index')->with(['success' => 'Data berhasil di buat']);
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
        $siswa = Siswa::findOrFail($id);
        return view('siswa.show', compact('siswa'));
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
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::pluck('name', 'id');
        return view('siswa.edit', compact('kelas', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
        $this->validate($request, [
            'name' => 'required|min:2|string',
            'nis' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'nullable'
        ]);

        $siswa->update([
            'name' => $request->name,
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kelas_id' => $request->kelas_id
        ]);
        return redirect()->route('siswas.index')->with(['success' => 'Data Berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
        $siswa->delete();

        return redirect()->route('siswas.index')->with(['success' => "Data Berhasil dihapus"]);
    }
}
