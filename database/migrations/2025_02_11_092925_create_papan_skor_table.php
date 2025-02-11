<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('papan_skor', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_olahraga');
            $table->integer('skor_a');
            $table->integer('skor_b');
            $table->integer('babak');
            $table->enum('tipe', ['win', 'fouls']); // Untuk menentukan apakah win / fouls
            $table->integer('tipe_jumlah_a');
            $table->integer('tipe_jumlah_b');
            $table->dateTime('tanggal')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papan_skor');
    }
};
