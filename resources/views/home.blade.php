@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Newtronic  Developer</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Studi kasus #1</h5>
                                    <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-primary">Detail <i class="bi bi-arrow-right"></i></a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Kami ingin anda membuat sebuah aplikasi transaksi sederhana mencakup semua proses (Create, Update, Delete dan Read).</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Studi kasus #2</h5>
                                    <a href="{{ route('crawl.index') }}" class="btn btn-sm btn-primary">Detail <i class="bi bi-arrow-right"></i></a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Anda diharuskan meng Crawl data dari https://www.smartdeal.co.id/rates/dki_banten, yang kami perlukan adalah data-data yang ada di tabel kurs.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Studi kasus #3</h5>
                                    <a href="{{ route('skor.index') }}" class="btn btn-sm btn-primary">Detail <i class="bi bi-arrow-right"></i></a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Kembangkan sebuah sistem papan skor olahraga yang menggunakan WebSocket untuk
                                        memperbarui skor pertandingan secara real-time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
