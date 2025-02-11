<?php

use App\Http\Controllers\CrawlController;
use App\Http\Controllers\PapanSkorController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

// Halaman Utama
Route::get('/', function () { return view('home'); });

// Crawl Data
Route::get('/crawl', [CrawlController::class, 'index'])->name('crawl.index');
Route::get('/crawl-aksi', [CrawlController::class, 'crawl'])->name('crawl.aksi');

Auth::routes();

// Halaman Utama
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Produk
Route::resource('/produk', ProdukController::class);

// Transaksi
Route::delete('/detail-transaksi/{id}', [TransaksiController::class, 'destroyProduct'])->name('transaksi.destroyProduct');
Route::resource('/transaksi', TransaksiController::class);

// Papan Skor
Route::get('/skor/last', [PapanSkorController::class, 'last'])->name('skor.last');
Route::get('/skor/detail', [PapanSkorController::class, 'detail'])->name('skor.detail');
Route::resource('/skor', PapanSkorController::class); 
