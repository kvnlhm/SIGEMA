<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariabelController;
use App\Http\Controllers\ClusteringController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/bersihkan', function() {
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('key:generate');
    return 'DONE';
});

//-- ADMIN --//
// Auth
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::get('/login', 'login')->name('login');
    Route::post('/store', 'store')->name('store');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});

// Variabel
Route::controller(VariabelController::class)->group(function () {
    Route::get('/variabel', 'index')->name('variabel');
    Route::post('/variabel', 'tambah');
    Route::post('/variabel/update', 'update');
    Route::get('/variabel/hapus/{id}', 'hapus');
});

// Clustering
Route::controller(ClusteringController::class)->group(function () {
    Route::get('/cluster', 'list')->name('cluster');
    Route::get('/clustering', 'index')->name('clustering');
    Route::get('/clustering2', 'index2')->name('clustering2');
    Route::get('/clustering/inisialisasi/{id}', 'inisialisasi')->name('clustering.inisialisasi');
    Route::get('/clustering/inisialisasi2/{id}', 'inisialisasi2')->name('clustering.inisialisasi2');
    Route::get('/clustering/download-excel/{jumlah}', 'downloadExcel');
    Route::get('/clustering/scale', 'showScale')->name('clustering.scale');
    Route::post('/clustering/process-upload', 'processUploadedFile')->name('clustering.process-upload');
    Route::post('/clustering/process-upload2', 'processUploadedFile2')->name('clustering.process-upload2');
    Route::get('/clustering/hapus/{id}', 'hapus');
    Route::post('/store-value', 'store')->name('store.value');
    Route::post('/save-processed-results', 'saveProcessedResults')->name('save.processed.results');
    Route::get('/load-previous-results/{id}', 'loadPreviousResults')->name('load.previous.results');
    Route::get('/clustering/hasil-proses/{id}', 'hasilProses')->name('hasil.proses');
    Route::get('/clustering/cetak-pdf/{id}', 'cetakPDF')->name('cetak.pdf');
});

// Panduan
Route::controller(PanduanController::class)->group(function () {
    Route::get('/panduan', 'index')->name('panduan');
    Route::post('/panduan', 'tambah');
    Route::post('/panduan/update', 'update');
    Route::get('/panduan/hapus/{id}', 'hapus');
});

// User
Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('user');
    Route::post('/user', 'tambah');
    Route::post('/user/update', 'update');
    Route::post('/user/updatepass', 'updatePass');
    Route::get('/user/hapus/{id}', 'hapus');
    Route::get('/user/profil', 'profil')->name('user.profil');
    Route::post('/user/profil/update', 'updateProfil');
    Route::post('/user/profil/updatepass', 'updateProfilPass');
});

// Log
Route::controller(LogController::class)->group(function () {
    Route::get('/log', 'index')->name('log');
    Route::get('/log/hapus/{id}', 'hapus');
});