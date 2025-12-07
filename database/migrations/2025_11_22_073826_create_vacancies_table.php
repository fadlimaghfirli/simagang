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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            // KUNCI: Menghubungkan tabel ini dengan tabel companies
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            $table->string('position');         // Posisi (misal: Web Developer)
            $table->text('description');        // Deskripsi Pekerjaan
            $table->integer('quota');           // Jumlah kuota penerimaan
            $table->boolean('is_active')->default(true); // Status aktif/tutup
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
