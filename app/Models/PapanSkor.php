<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapanSkor extends Model
{
    use HasFactory;
    protected $table = 'papan_skor';
    protected $fillable = ['jenis_olahraga', 'skor_a', 'skor_b', 'babak', 'tipe', 'tipe_jumlah_a', 'tipe_jumlah_b', 'tanggal'];
}
