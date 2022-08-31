<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('auth/login');
    }
});

// Auth::routes();
Auth::routes(['register' => false, 'reset' => false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('kelas', KelasController::class);
    Route::get('/ajax/kelas/search', [KelasController::class, 'ajaxSearch']);
    Route::resource('tahunajaran', TahunAjaranController::class);
    Route::resource('siswas', SiswaController::class);
    Route::get('/ajax/siswa/search', [SiswaController::class, 'ajaxSearchKelas']);
    Route::resource('siswas/{id}/notes', NotesController::class);
});
