<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totallaki = Siswa::where('jenis_kelamin', 'Laki-Laki')->count();
        $totalperempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();
        $totalall = Siswa::count();
        return view('home', compact('totallaki', 'totalperempuan', 'totalall'));
    }
}
