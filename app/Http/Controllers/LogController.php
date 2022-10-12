<?php

namespace App\Http\Controllers;

use App\Models\LogSiswa;
use Illuminate\Http\Request;

class LogController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:log-list', ['only' => ['index']]);
    }

    //
    public function index()
    {
        // $logs = LogSiswa::latest()->paginate(15);
        $logs = LogSiswa::latest()->paginate(15);

        return view('log.index', compact('logs'));
    }
}
