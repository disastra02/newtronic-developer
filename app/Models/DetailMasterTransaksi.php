<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMasterTransaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_master_transaksi';
    protected $fillable = ['id_transaksi', 'id_produk', 'quantity'];

    // Jika menghapus transaksi
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($transaksi) {
            $produk = $transaksi->produk;
            $produk->stok += $transaksi->quantity; // Kembalikan stok
            $produk->save(); // Simpan perubahan stok produk
        });
    }


    public function produk()
    {
        return $this->hasOne(Produk::class, 'id', 'id_produk')->withTrashed();
    }
}
