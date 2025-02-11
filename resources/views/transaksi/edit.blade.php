@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            {{ __('Perbarui Data Transaksi') }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transaksi.update', $detail->id) }}">
                        @csrf
                        @method('PUT')

                        @if(session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $produk->produk }}</td>
                                        <td>{{ $produk->harga }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td width="10%">
                                            <input type="hidden" name="produk" value="{{ $produk->id }}">
                                            <input id="quantity" type="number" min="1" class="form-control" name="quantity" value="{{ $detail->quantity }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                                <a href="{{ route('transaksi.show', $detail->id_transaksi) }}" class="btn btn-danger">
                                    {{ __('Batal') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
