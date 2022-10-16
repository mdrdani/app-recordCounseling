<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\LogSiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:kelas-list|kelas-create|kelas-edit|kelas-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kelas-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kelas-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kelas-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $kelass = Kelas::latest()->paginate(6);
        $filterKeyword = $request->get('name');

        if ($filterKeyword) {
            $kelass = Kelas::where("name", "LIKE", "%$filterKeyword%")->latest()->paginate(6);
        }
        return view('kelas.index', compact('kelass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $users = User::all();
        $users = User::whereHas('roles', function ($subQuery) {
            $subQuery->where('name', 'guru');
        })->get();
        $tahun_ajarans = TahunAjaran::all();
        return view('kelas.create', compact('users', 'tahun_ajarans'));
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
            'jenjang' => 'required|string',
            'name' => 'required|string|min:3',
            'user_id' => 'required',
            'tahunajaran_id' => 'required'
        ]);

        $kelas = new Kelas;
        $kelas->id = $request->id;
        $kelas->jenjang = $request->jenjang;
        $kelas->name = $request->name;
        $kelas->user_id = $request->user_id;
        $kelas->tahunajaran_id = $request->tahunajaran_id;
        $kelas->save();

        // log data
        $log = new LogSiswa;
        $log->user_id = Auth::user()->id;
        $log->method = 'Membuat Kelas Baru ' . $kelas->name;
        $log->save();


        return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil dibuat']);
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
        $kelas = Kelas::find($id);
        $wali_kelas = User::pluck('name', 'id');
        $tahun_ajaran = TahunAjaran::pluck('tahun', 'id');

        return view('kelas.edit', compact('kelas', 'wali_kelas', 'tahun_ajaran'));
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
            'jenjang' => 'required|string',
            'name' => 'required|string|min:3',
            'user_id' => 'required',
            'tahunajaran_id' => 'required'
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->jenjang = $request->jenjang;
        $kelas->name = $request->name;
        $kelas->user_id = $request->user_id;
        $kelas->tahunajaran_id = $request->tahunajaran_id;
        $kelas->save();


        // log data
        $log = new LogSiswa;
        $log->user_id = Auth::user()->id;
        $log->method = 'Perbarui Kelas ' . $kelas->name;
        $log->save();


        return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Di Update']);
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
        Kelas::find($id)->delete();
        // log data
        $log = new LogSiswa;
        $log->user_id = Auth::user()->id;
        $log->method = 'Menghapus Kelas';
        $log->save();

        return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get("q");
        $user = User::where("name", "LIKE", "%$keyword%")->whereHas('roles', function ($subQuery) {
            $subQuery->where('name', 'guru');
        })->get();

        return $user;
    }
}
