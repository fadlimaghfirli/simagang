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
        Schema::table('applications', function (Blueprint $table) {
            // Nilai Bimbingan (Sikap/Keaktifan) - Skala 0-100
            $table->integer('score_bimbingan')->nullable();

            // Nilai Laporan Akhir (Kualitas Tulisan/Substansi) - Skala 0-100
            $table->integer('score_laporan')->nullable();

            // Nilai Akhir (Rata-rata atau Bobot)
            $table->decimal('final_score', 5, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['score_bimbingan', 'score_laporan', 'final_score']);
        });
    }
};
