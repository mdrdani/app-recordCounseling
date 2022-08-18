<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('auth/login');
});

// Auth::routes(['register' => false, 'reset' => false]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('kelas', KelasController::class)->except(['show']);
    Route::resource('tahunajaran', TahunAjaranController::class)->except(['show']);
    Route::resource('siswas', SiswaController::class);
});
