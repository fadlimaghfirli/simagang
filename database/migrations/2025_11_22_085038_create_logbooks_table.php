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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            // Mahasiswa yang mengisi
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->date('date');           // Tanggal Kegiatan
            $table->text('activity');       // Uraian Kegiatan
            $table->string('evidence')->nullable(); // Bukti Foto (Opsional)

            // Status validasi dosen
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable(); // Komentar dosen jika ditolak/revisi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
