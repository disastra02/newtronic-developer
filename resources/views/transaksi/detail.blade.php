@extends('layouts.app')

@section('style')
    <style>
        th {
            font-weight: normal !important;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            {{ __('Detail Transaksi') }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="6">
                                        <div class="d-flex justify-content-between">
                                            <span>No Transaksi</span>
                                            <span>{{ $transaksi->kode_transaksi }}</span>
                                        </div> 
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6">
                                        <div class="d-flex justify-content-between">
                                            <span>Tanggal</span>
                                            <span>{{ $transaksi->tanggal }}</span>
                                        </div> 
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi->detail as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->produk->produk }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->produk->harga, 2, ',', '.') }}</td>
                                        <td>{{ number_format($item->quantity * $item->produk->harga, 2, ',', '.') }}</td>
                                        <td width="10%">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.destroyProduct', $item->id) }}" method="POST">
                                                <div class="btn-group" role="group">
                                                    <!-- Jika produk sudah dihapus, data tidak bisa diperbarui -->
                                                    <a type="button" class="btn btn-warning {{ $item->produk->deleted_at ? 'disabled' : '' }}" href="{{ route('transaksi.edit', $item->id) }}">Perbarui</a>
        
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12 text-end">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-danger">
                                {{ __('Kembali') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
