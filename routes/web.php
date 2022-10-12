<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use App\Models\TahunAjaran;

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
    // route roles
    Route::resource('roles', RoleController::class);

    // route user
    Route::get('users/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('users/profile/{user}', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::resource('users', UserController::class);

    // route kelas
    Route::resource('kelas', KelasController::class);
    Route::get('/ajax/kelas/search', [KelasController::class, 'ajaxSearch']);

    // route tahun ajaran
    Route::post('tahunajaran/{id}/restore', [TahunAjaranController::class, 'restore'])->name('tahunajaran.restore');
    Route::resource('tahunajaran', TahunAjaranController::class);

    // route siswa
    Route::resource('siswas', SiswaController::class);
    Route::get('/ajax/siswa/search', [SiswaController::class, 'ajaxSearchKelas']);
    Route::resource('siswas/{id}/notes', NotesController::class);

    // route log
    Route::get('log', [LogController::class, 'index'])->name('log.index');
});
