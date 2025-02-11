@extends('layouts.app')

@section('style')
    <style>
        .text-skor {
            font-size: 5.5rem !important;
            font-weight: bolder;
        }

        .text-skor.basket {
            font-size: 7.5rem !important;
        }

        .text-skor.voli {
            font-size: 7.5rem !important;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Papan Skor') }}</div>
                <div class="card-body bg-dark text-white">
                    <div id="skorPreview"><span class="text-white">Belum ada skor</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.2/dist/echo.iife.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pusher-js@7.0.3/dist/web/pusher.min.js"></script>
    <script>
        // Inisialisasi Laravel Echo
        window.Pusher = Pusher;
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '123321',
            wsHost: `{{ env('PUSHER_HOST', '127.0.0.1') }}`,
            wsPort: 6001,
            forceTLS: false,
            disableStats: true,
        });

        // Menerima event update
        Echo.channel('papan').listen('.updateskor',(data) => {
            let html = showHtml(data);

            $('#skorPreview').html(html);

        });

        // Ambil data terakhir
        $.ajax({
            type:'GET',
            url: `{{ route('skor.last') }}`,
            contentType: false,
            processData: false,
            success: (data) => {
                let html = showHtml(data);

                $('#skorPreview').html(html);
            }
        });

        let showHtml = (data) => {
            let html = 'Belum ada skor';

            if (data.jenis_olahraga == "sepak bola") {
                html = `<div class="row text-center">
                        <div class="col-md-12">
                            <h1 class="mb-5 text-danger">SEPAK BOLA</h1>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4">
                            <h1 class="mb-4 text-danger fw-bold">HOME</h1>
                            <h4 class="mb-0">SCORE</h4>
                            <h1 class="text-danger text-skor">${data.skor_a}</h1>
                            <h4 class="mb-0">FOULS</h4>
                            <h1 class="text-danger fw-bolder">${data.tipe_jumlah_a}</h1>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4">
                            <h1 class="mb-4 text-danger">VS</h1>
                            <h4 class="mb-0">BABAK</h4>
                            <h1>${data.babak}</h1>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4">
                            <h1 class="mb-4 text-danger fw-bold">GUEST</h1>
                            <h4 class="mb-0">SCORE</h4>
                            <h1 class="text-success text-skor">${data.skor_b}</h1>
                            <h4 class="mb-0">FOULS</h4>
                            <h1 class="text-success fw-bolder">${data.tipe_jumlah_b}</h1>
                        </div>
                    </div>`;
            }

            if (data.jenis_olahraga == "basket") {
                html = `<div class="row text-center">
                        <div class="col-md-12">
                            <h1 class="mb-5 text-danger">BASKET</h1>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <h1 class="mb-2 text-danger fw-bold">HOME</h1>
                            <h1 class="text-primary text-skor basket">${data.skor_a}</h1>
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-12 mb-4">
                            <h4 class="mb-0 mt-4">FOULS</h4>
                            <h1 class="text-warning fw-bolder">${data.tipe_jumlah_a}</h1>
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-12">
                            <h4 class="mb-0">PERIOD</h4>
                            <h1 class="text-warning fw-bolder">${data.babak}</h1>
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-12">
                            <h4 class="mb-0 mt-4">FOULS</h4>
                            <h1 class="text-warning fw-bolder">${data.tipe_jumlah_b}</h1>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <h1 class="mb-2 text-danger fw-bold">GUEST</h1>
                            <h1 class="text-success text-skor basket">${data.skor_b}</h1>
                        </div>
                    </div>`;
            }

            if (data.jenis_olahraga == "voli") {
                html = `<div class="row text-center">
                        <div class="col-md-12">
                            <h1 class="mb-5 text-danger">VOLI</h1>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <h1 class="mb-2 fw-bold">HOME</h1>
                            <h1 class="text-danger text-skor voli">${data.skor_a}</h1>
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-12 mb-4">
                            <h4 class="mb-0">WIN</h4>
                            <h1 class="text-primary fw-bolder">${data.tipe_jumlah_a}</h1>
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-12 mb-4">
                            <h1 class="text-primary fw-bolder">${data.babak}</h1>
                            <h4 class="mb-0">SET</h4>
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-12">
                            <h4 class="mb-0">WIN</h4>
                            <h1 class="text-primary fw-bolder">${data.tipe_jumlah_b}</h1>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <h1 class="mb-2 fw-bold">GUEST</h1>
                            <h1 class="text-success text-skor voli">${data.skor_b}</h1>
                        </div>
                    </div>`;
            }

            return html;
        }
    </script>
@endsection
