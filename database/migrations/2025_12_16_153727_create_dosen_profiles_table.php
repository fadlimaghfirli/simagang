<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosen_profiles', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (Cascade: jika user dihapus, profil ikut terhapus)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Atribut Khusus Dosen
            $table->string('nip')->unique()->nullable();  // NIP (Nomor Induk Pegawai)
            $table->string('nidn')->unique()->nullable(); // NIDN (Nomor Induk Dosen Nasional)
            $table->string('kode_dosen')->nullable();     // Opsional: Kode Dosen (misal: FD)
            $table->string('no_hp')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_profiles');
    }
};
