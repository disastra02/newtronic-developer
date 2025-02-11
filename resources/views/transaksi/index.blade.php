@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            {{ __('Data Transaksi') }}
                        </div>
                        <div class="col-md-6">
                            <div class="text-end">
                                <a class="btn btn-primary" href="{{ route('transaksi.create') }}">Tambah Transaksi</a>
                            </div>
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

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td width="15%">
                                        <div class="btn-group" role="group">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.destroy', $item->id) }}" method="POST">
                                                <div class="btn-group" role="group">
                                                    <a type="button" class="btn btn-success" href="{{ route('transaksi.show', $item->id) }}">Detail</a>
    
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
