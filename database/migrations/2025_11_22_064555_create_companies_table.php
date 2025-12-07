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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Nama Perusahaan
            $table->string('email')->nullable(); // Email Perusahaan (opsional)
            $table->string('address')->nullable(); // Alamat
            $table->string('website')->nullable(); // Website
            $table->string('pic')->nullable();     // Nama Penanggung Jawab (PIC)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
