<?php

namespace App\Http\Controllers;

use App\Events\PapanSkorUpdated;
use App\Models\PapanSkor;
use Illuminate\Http\Request;

class PapanSkorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('papan_skor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('papan_skor.create');
    }

    public function detail()
    {
        return view('papan_skor.show');
    }

    public function last()
    {
        $data = PapanSkor::latest()->first();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_olahraga' => 'required|string',
            'skor_a' => 'nullable|integer',
            'skor_b' => 'nullable|integer',
            'babak' => 'nullable|integer',
            'tipe_jumlah_a' => 'nullable|integer',
            'tipe_jumlah_b' => 'nullable|integer'
        ]);

        $tipe = $request->jenis_olahraga == "voli" ? 'win' : 'fouls';
        $skor_a = $request->skor_a ?? 0;
        $skor_b = $request->skor_b ?? 0;

        $tipe_jumlah_a = $request->tipe_jumlah_a ?? 0;
        $tipe_jumlah_b = $request->tipe_jumlah_b ?? 0;

        // Mencatata log skor
        PapanSkor::create([
            'jenis_olahraga' => $request->jenis_olahraga,
            'skor_a' => $skor_a,
            'skor_b' => $skor_b,
            'babak' => $request->babak,
            'tipe' => $tipe,
            'tipe_jumlah_a' => $tipe_jumlah_a,
            'tipe_jumlah_b' => $tipe_jumlah_b,
            'tanggal' => now()
        ]);

        broadcast(new PapanSkorUpdated($request->jenis_olahraga, $skor_a, $skor_b, $request->babak, $tipe, $tipe_jumlah_a, $tipe_jumlah_b));

        return response()->json(['message' => 'Skor Diperbarui']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
