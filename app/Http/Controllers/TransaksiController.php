<?php

namespace App\Http\Controllers;

use App\Models\DetailMasterTransaksi;
use App\Models\MasterTransaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['transaksi'] = MasterTransaksi::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['produk'] = Produk::orderBy('produk', 'ASC')->get();

        return view('transaksi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi jika total quantity null / tidak ada
        $total_quantity = array_sum($request->quantity);
        if ($total_quantity == 0) {
            return back()->with('error', 'Silahkan masukkan jumlah quantity produk');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        $transaksi = MasterTransaksi::create([
            'id_user' => Auth::user()->id,
            'kode_transaksi' => '',
            'tanggal' => now()
        ]);

        // Generate kode_transaksi setelah ID di-generate
        $transaksi->kode_transaksi = $transaksi->id . now()->format('Ymd');
        $transaksi->save();

        // Proses setiap produk yang dipilih
        foreach ($request->produk as $id) {
            $quantity = $request->quantity[$id];

            // Jika quantity ada maka diproses
            if ($quantity > 0) {
                $produk = Produk::find($id);
    
                // Validasi stok, pastikan quantity tidak melebihi stok yang ada
                if ($produk->stok < $quantity) {
                    // Jika stok kurang, lakukan rollback dan kirim pesan error
                    DB::rollBack();
                    return back()->with('error', 'Stok untuk ' . $produk->produk . ' tidak mencukupi');
                }
    
                // Kurangi stok produk
                $produk->stok -= $quantity;
                $produk->save();
    
                // Simpan detail transaksi
                DetailMasterTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_produk' => $produk->id,
                    'quantity' => $quantity,
                ]);
            }
        }

        // Jika semua berhasil, commit transaksi
        DB::commit();

        // Kembalikan respon sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['transaksi'] = MasterTransaksi::with('user', 'detail.produk')->find($id);

        return view('transaksi.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail_transaksi = DetailMasterTransaksi::find($id);
        $data['detail'] = $detail_transaksi;
        $data['produk'] = Produk::where('id', $detail_transaksi->id_produk)->first();

        return view('transaksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $detail_transaksi = DetailMasterTransaksi::find($id);

        // Perbarui transaksi
        $transaksi = MasterTransaksi::find($detail_transaksi->id_transaksi);

        // Mulai transaksi database
        DB::beginTransaction();

        // Perbarui transaksi
        $transaksi->tanggal = now();
        $transaksi->save();

        // Kembalikan stok
        $produk = $detail_transaksi->produk;
        $produk->stok += $detail_transaksi->quantity;
        $produk->save();

        // Memperbarui detail transaksi
        $quantity = $request->quantity;
        if ($quantity > 0) {
            // Validasi stok, pastikan quantity tidak melebihi stok yang ada
            if ($produk->stok < $quantity) {
                // Jika stok kurang, lakukan rollback dan kirim pesan error
                DB::rollBack();
                return back()->with('error', 'Stok untuk ' . $produk->produk . ' tidak mencukupi');
            }

            // Kurangi stok produk
            $produk->stok -= $quantity;
            $produk->save();

            // Simpan detail transaksi
            $detail_transaksi->update([
                'quantity' => $quantity,
            ]);
        }

        // Jika semua berhasil, commit transaksi
        DB::commit();

        // Kembalikan respon sukses
        return redirect()->route('transaksi.show', $transaksi->id)->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = MasterTransaksi::find($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }

    public function destroyProduct(string $id)
    {
        $detail_transaksi = DetailMasterTransaksi::find($id);
        $transaksi = MasterTransaksi::find($detail_transaksi->id_transaksi);
        
        // Menghapus detail transaksi
        $detail_transaksi->delete();
        
        // Jika detail transaksi 0, maka transaksi dihapus
        if ($transaksi->detail->count() < 1) {
            $transaksi->delete();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
        }

        return redirect()->route('transaksi.show', $transaksi->id)->with('success', 'Produk berhasil dihapus');
    }
}
