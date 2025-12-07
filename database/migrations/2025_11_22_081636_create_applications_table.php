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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Relasi ke User (Mahasiswa)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Relasi ke Lowongan
            $table->foreignId('vacancy_id')->constrained()->onDelete('cascade');

            // Tanggal Melamar
            $table->date('apply_date');

            // Status Pendaftaran
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // Lokasi File (Path)
            $table->string('cv_path');        // File CV
            $table->string('transcript_path')->nullable(); // File Transkrip (Opsional)

            // Catatan dari Dosen/Admin (misal: "CV kurang lengkap")
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
