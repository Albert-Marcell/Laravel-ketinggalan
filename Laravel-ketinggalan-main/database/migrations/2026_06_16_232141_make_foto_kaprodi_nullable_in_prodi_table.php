<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Mengubah kolom foto_kaprodi menjadi nullable
     * agar Prodi bisa dibuat tanpa foto (misal: dari seeder).
     */
    public function up(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->string('foto_kaprodi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->string('foto_kaprodi')->nullable(false)->change();
        });
    }
};
