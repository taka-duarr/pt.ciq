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
        Schema::table('produks', function (Blueprint $table) {
            $table->text('deskripsi_singkat')->nullable()->after('stok');
            $table->text('deskripsi_lengkap')->after('deskripsi_singkat');
            $table->text('keunggulan')->after('deskripsi_lengkap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn(['deskripsi_singkat', 'deskripsi_lengkap', 'keunggulan']);
        });
    }
};
