<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Atribut Khusus Mahasiswa
            $table->string('nim')->unique()->nullable();
            $table->string('angkatan', 4)->nullable(); // Misal: 2022
            $table->string('kelas')->nullable();       // Misal: A, B, C
            $table->string('no_hp')->nullable();

            // Relasi ke Dosen Wali (mengambil ID dari tabel users milik dosen)
            // Nullable karena mhs baru mungkin belum punya dosen wali
            $table->foreignId('dosen_wali_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_profiles');
    }
};
