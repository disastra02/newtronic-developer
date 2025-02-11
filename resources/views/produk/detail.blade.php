@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            {{ __('Detail Data Produk') }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="produk" class="col-md-4 col-form-label text-md-end">{{ __('Produk') }}</label>

                        <div class="col-md-6">
                            <input id="produk" type="text" class="form-control @error('produk') is-invalid @enderror" name="produk" value="{{ old('produk', $item->produk) }}" disabled>

                            @error('produk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="stok" class="col-md-4 col-form-label text-md-end">{{ __('Stok') }}</label>

                        <div class="col-md-6">
                            <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok', $item->stok) }}" disabled>

                            @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="harga" class="col-md-4 col-form-label text-md-end">{{ __('Harga') }}</label>

                        <div class="col-md-6">
                            <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga', $item->harga) }}" disabled>

                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <a href="{{ route('produk.index') }}" class="btn btn-danger">
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
