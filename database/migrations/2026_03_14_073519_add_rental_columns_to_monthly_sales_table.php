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
        Schema::table('monthly_sales', function (Blueprint $table) {
            $table->decimal('sewa_loader', 15, 2)->default(0)->after('crusher_production');
            $table->decimal('sewa_dump_truck', 15, 2)->default(0)->after('sewa_loader');
            $table->decimal('sewa_sany', 15, 2)->default(0)->after('sewa_dump_truck');
            $table->decimal('sewa_hyundai_220', 15, 2)->default(0)->after('sewa_sany');
            $table->decimal('sewa_hyundai_330', 15, 2)->default(0)->after('sewa_hyundai_220');
            $table->decimal('spare_part', 15, 2)->default(0)->after('sewa_hyundai_330');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_sales', function (Blueprint $table) {
            $table->dropColumn([
                'sewa_loader',
                'sewa_dump_truck',
                'sewa_sany',
                'sewa_hyundai_220',
                'sewa_hyundai_330',
                'spare_part'
            ]);
        });
    }
};
