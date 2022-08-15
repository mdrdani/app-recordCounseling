<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tahunajarans = TahunAjaran::orderBy('id', 'DESC')->paginate(5);
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
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'tahun' => 'required|min:2'
        ]);

        $tahun = new TahunAjaran;
        $tahun->id = $request->id;
        $tahun->tahun = $request->tahun;
        $tahun->save();

        return redirect()->route('tahunajaran.index')->with('success', 'Create Tahun Ajaran Success');
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
        $tahun = TahunAjaran::findOrFail($id);
        return view('tahunajaran.edit', compact('tahun'));
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
        $this->validate($request, [
            'tahun' => 'required|min:2'
        ]);
        $tahun = TahunAjaran::findOrFail($id);
        $tahun->tahun = $request->tahun;
        $tahun->save();

        return redirect()->route('tahunajaran.index')->with('success', 'Update Tahun ajaran Success');
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
        $tahun = TahunAjaran::findOrFail($id);
        $tahun->delete();

        return redirect()->route('tahunajaran.index')->with('success', 'Delete Tahun Ajaran Success');
    }
}
