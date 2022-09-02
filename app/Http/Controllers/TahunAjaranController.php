<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:tahunajaran-list|tahunajaran-create|tahunajaran-edit|tahunajaran-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:tahunajaran-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tahunajaran-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tahunajaran-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tahunajarans = TahunAjaran::orderBy('id', 'DESC')->withTrashed()->paginate(5);
        return view('tahunajaran.index', compact('tahunajarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tahunajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TahunAjaran $tahunajaran)
    {
        //
        $this->validate($request, [
            'tahun' => 'required|min:2'
        ]);

        $tahunajaran->create($request->all());

        return redirect()->route('tahunajaran.index')->with(['success' => 'Data Berhasil Dibuat!']);
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
    public function edit(TahunAjaran $tahunajaran)
    {
        //
        return view('tahunajaran.edit', compact('tahunajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAjaran $tahunajaran)
    {
        //
        $this->validate($request, [
            'tahun' => 'required|min:2'
        ]);

        $tahunajaran->update($request->all());

        return redirect()->route('tahunajaran.index')->with(['success' => 'Data Berhasil Diubah!']);
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

        $tahunajaran = TahunAjaran::findOrFail($id);
        $tahunajaran->delete();

        return redirect()->route('tahunajaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
