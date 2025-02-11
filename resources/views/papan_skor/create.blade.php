@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Operator Skor') }}</div>
                <div class="card-body">
                    <div id="alert"></div>

                    <form id="formSkor" action="{{ route('skor.store') }}" class="mb-0">
                        @csrf

                        <div class="mb-3">
                            <label for="jenisOlahraga" class="form-label">Jenis Olahraga</label>
                            <select class="form-select" name="jenis_olahraga" id="jenisOlahraga">
                                <option value="sepak bola">Sepak Bola</option>
                                <option value="basket">Basket</option>
                                <option value="voli">Voli</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="babak" class="form-label">Babak</label>
                            <input type="number" class="form-control" min="1" name="babak" id="babak" placeholder="Masukkan babak" required>
                        </div>

                        <hr>
                        <p class="fw-bold text-center">Skor</p>
                        <div class="row">
                            <div class="col-md-6 text-center mb-3">
                                <label for="skor_a" class="form-label">Home</label>
                                <input type="number" class="form-control" min="0" name="skor_a" id="skor_a" placeholder="Masukkan Jumlah Home">
                            </div>
                            <div class="col-md-6 text-center mb-3">
                                <label for="skor_b" class="form-label">Guest</label>
                                <input type="number" class="form-control" min="0" name="skor_b" id="skor_b" placeholder="Masukkan Jumlah Guest">
                            </div>
                        </div>
                        
                        <hr>
                        <p class="fw-bold text-center" id="textTipe">Fouls</p>
                        <div class="row">
                            <div class="col-md-6 text-center mb-3">
                                <label for="tipe_jumlah_a" class="form-label">Home</label>
                                <input type="number" class="form-control" min="0" name="tipe_jumlah_a" id="tipe_jumlah_a" placeholder="Masukkan Jumlah Home">
                            </div>
                            <div class="col-md-6 text-center mb-3">
                                <label for="tipe_jumlah_b" class="form-label">Guest</label>
                                <input type="number" class="form-control" min="0" name="tipe_jumlah_b" id="tipe_jumlah_b" placeholder="Masukkan Jumlah Guest">
                            </div>
                        </div>

                        <div class="row justify-content-center mb-0">
                            <div class="col-md-4 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                            <div class="col-md-4 d-grid">
                                <a type="button" href="{{ route('skor.index') }}" class="btn btn-danger">
                                    {{ __('Kembali') }}
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
            wsHost: '127.0.0.1',
            wsPort: 6001,
            forceTLS: false,
            disableStats: true,
        });

        // Submit data skor
        $('#formSkor').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr("action");
            let formData = new FormData(this);

            $.ajax({
                    type:'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        let html = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Data skor berhasil diperbarui
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>`;

                        $('#alert').html(html);
                    },
                    error: function(response){
                        console.log(response.responseJSON.message)
                    }
            });
        });

        // Manipulasi judul tipe
        $('#jenisOlahraga').change(function() {
            let text = $(this).val() == "voli" ? "Win" : "Fouls";

            $('#textTipe').text(text);
        });
    </script>
@endsection
