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
        Schema::create('crawl_data', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable();
            $table->string('denomination')->nullable();
            $table->decimal('buy_rate', 15, 3);
            $table->decimal('sell_rate', 15, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crawl_data');
    }
};
