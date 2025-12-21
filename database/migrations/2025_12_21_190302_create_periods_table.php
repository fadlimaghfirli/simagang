<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: "2024/2025 Gasal"
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(false); // Flag periode aktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periods');
    }
};
