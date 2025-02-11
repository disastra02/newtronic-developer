@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Papan Skor') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">Tampilan Skor</div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-9">
                                            <p class="card-text">Mendukung tampilan skor untuk berbagai jenis olahraga dan memungkinkan operator untuk memperbarui skor dari interface yang sederhana</p>
                                        </div>
                                        <div class="col-md-3 text-end">
                                            <a href="{{ route('skor.detail') }}" class="btn btn-primary">Detail <i class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">Tampilan Operator</div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-9">
                                            <p class="card-text">Interface sederhana yang memungkinkan operator memasukkan skor terbaru yang akan langsung terlihat pada papan skor</p>
                                        </div>
                                        <div class="col-md-3 text-end">
                                            <a href="{{ route('skor.create') }}" class="btn btn-primary">Detail <i class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
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
