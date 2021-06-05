<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DivisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UnitKerja;
use App\Http\Livewire\Jenisuser;
use App\Http\Livewire\Pegawai\Index;
use App\Http\Livewire\Pegawai\Tambahpegawai;
use App\Models\Pegawai;

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
    return view('welcome');
});

Route::group([ "middleware" => ['auth:sanctum', 'verified'] ], function() {
    // Route::view('/dashboard', "dashboard")->name('dashboard');
    Route::get('/dashboard', function () {
        if (auth()->user()->roles == 0) {
            return redirect('dashboard/admin');
        } elseif (auth()->user()->roles == 1) {
            return redirect('dashboard/user');
        } else {
            return 'hayo iseng ya';
        }
    })->name('dashboard');

    Route::group(['prefix' => 'dashboard/admin', 'middleware' => ['Cek_login:admin']], function(){
        /**
         * Route untuk sisi admin
         */
        Route::view('/', "dashboard")->name('dashboard_admin');
        Route::get('unit_kerja', UnitKerja::class)->name('unit_kerja');
        Route::get('divisi', [ DivisiController::class, "index_view" ])->name('divisi');
        Route::get('jenisuser', Jenisuser::class)->name('jenisuser');

        Route::get('pegawai', Index::class)->name('dtpegawai');
        Route::view('pegawai/tambahpegawai', "pages.pegawai.add-pegawai")->name('tambah_pegawai');
        Route::view('pegawai/ubahpegawai/{pegawaiId}', "pages.pegawai.edit-pegawai")->name('ubah_pegawai');

        Route::view('reminder', "pages.reminder.index-reminder")->name('reminder_index');

    });

    Route::group(['prefix' => 'dashboard/user', 'middleware' => ['Cek_login:user']], function(){
        /**
         */
        Route::view('/', "dashboard-user")->name('dashboard_user'); // diubah lagi waktu selesai layouting user

        // Route::get('/', function () {
        //     return 'ini User ';
        // });
    });

    /**
     * Route manage users dihilangkan
     */
    // Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    // Route::view('/user/new', "pages.user.user-new")->name('user.new');
    // Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');





});
