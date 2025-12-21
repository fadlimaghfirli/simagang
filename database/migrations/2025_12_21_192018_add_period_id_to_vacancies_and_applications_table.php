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
        Schema::table('vacancies', function (Blueprint $table) {
            // Nullable agar data lama tidak error, constrained ke tabel periods
            $table->foreignId('period_id')->nullable()->after('id')->constrained('periods')->nullOnDelete();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->foreignId('period_id')->nullable()->after('id')->constrained('periods')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('vacancies', function (Blueprint $table) {
            $table->dropForeign(['period_id']);
            $table->dropColumn('period_id');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['period_id']);
            $table->dropColumn('period_id');
        });
    }
};
