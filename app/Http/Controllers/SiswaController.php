<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Kelas;
use App\Models\LogSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:siswa-list|siswa-create|siswa-edit|siswa-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:siswa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:siswa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:siswa-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user_id = auth()->user()->id;

        $kelas = Kelas::where('user_id', $user_id)->first();
        if (!$kelas) {
            $siswas = Siswa::latest()->paginate(10);
        } else {
            $siswas = Siswa::where('kelas_id', $kelas->id)->latest()->paginate(10);
        }
        $filterKeyword = $request->get('name');

        if ($filterKeyword) {
            if (!$kelas) {
                $siswas = Siswa::where("name", "LIKE", "%$filterKeyword%")
                    ->paginate(10);
            } else {
                $siswas = Siswa::where('kelas_id', $kelas->id)
                    ->where("name", "LIKE", "%$filterKeyword%")
                    ->paginate(10);
            }
        }

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

        // log data Siswa
        $log = new LogSiswa;
        $log->user_id = Auth::user()->id;
        $log->siswa_id = $siswa->id;
        $log->method = 'Membuat Siswa Baru  (' . $log->Siswa->name . ')';
        $log->save();

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
        $note = Note::Orderby('id', 'asc')->where('siswa_id', $id)->get();
        $notes = $note->reverse();
        // dd($notes);
        return view('siswa.show', compact('siswa', 'notes'));
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
        $kelas = Kelas::all();
        return view('siswa.edit', compact('kelas', 'siswa'));
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
            'name' => 'required|min:2|string',
            'nis' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'nullable'
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->name = $request->name;
        $siswa->nis = $request->nis;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->save();

        // log data siswa
        $log = new LogSiswa;
        $log->user_id = Auth::user()->id;
        $log->siswa_id = $siswa->id;
        $log->kelas_id = $siswa->kelas_id;
        $log->method = 'Memperbarui Siswa ' . $log->Siswa->name . ' ( Kelas-' . $log->Kelas->name . ' | T.A ' . $log->Kelas->TahunAjaran->tahun . ')';
        $log->save();


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

        // log data siswa
        $log = new LogSiswa;
        $log->user_id = Auth::user()->id;
        $log->siswa_id = $siswa->id;
        $log->method = 'Menghapus Data Siswa ' . $log->Siswa->name;
        $log->save();

        return redirect()->route('siswas.index')->with(['success' => "Data Berhasil dihapus"]);
    }

    public function ajaxSearchKelas(Request $request)
    {
        $keyword = $request->get("q");
        $kelas = Kelas::where("name", "LIKE", "%$keyword%")->get();

        return $kelas;
    }
}
