<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTransaksi extends Model
{
    use HasFactory;
    protected $table = 'master_transaksi';
    protected $fillable = ['id_user', 'kode_transaksi', 'tanggal'];

    // Jika menghapus transaksi
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($transaksi) {
            // Ambil semua detail transaksi yang terkait
            $detailTransaksis = $transaksi->detail;

            foreach ($detailTransaksis as $detail) {
                $produk = $detail->produk; 
                $produk->stok += $detail->quantity; // Kembalikan stok
                $produk->save(); // Simpan perubahan stok produk

                // Menghapus detail transaksi
                $detail->delete();
            }
        });
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function detail()
    {
        return $this->hasMany(DetailMasterTransaksi::class, 'id_transaksi', 'id');
    }
}
