<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasil_prediksi', function (Blueprint $table) {
            $table->id(); // auto increment primary key
            $table->float('diameter')->nullable();
            $table->float('berat')->nullable();
            $table->float('kadar_gula')->nullable();
            $table->string('warna', 20)->nullable();
            $table->string('asal_daerah', 50)->nullable();
            $table->string('musim_panen', 50)->nullable();
            $table->string('hasil', 50)->nullable();

            $table->timestamps(); // uncomment jika ingin ada created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_prediksi');
    }
};
