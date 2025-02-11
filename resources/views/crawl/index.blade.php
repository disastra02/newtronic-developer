@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Crawl Data') }}</div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-error alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}, link untuk <a href="{{ url('api/crawl-data-json') }}" target="_blank">preview JSON.</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <p class="card-text">
                        Crawl data dari <a target="_blank" href="https://www.smartdeal.co.id/rates/dki_banten">https://www.smartdeal.co.id/rates/dki_banten</a> dan menampilkan data-data yang ada di tabel kurs. 
                    </p>
                    <div class="">
                        <a href="{{ route('crawl.aksi') }}" class="btn btn-primary">Crawl Data</a>
                        @if (!$crawl->isEmpty())
                            <a href="{{ url('api/crawl-data-json') }}" target="_blank" class="btn btn-success">JSON Data</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
