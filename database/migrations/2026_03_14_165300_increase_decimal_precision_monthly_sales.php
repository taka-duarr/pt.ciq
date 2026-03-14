<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Increase decimal precision for production-related columns from decimal(15,2) to decimal(20,5)
     * so values like 8451.135 are stored exactly and not rounded to 8451.14.
     */
    public function up(): void
    {
        Schema::table('monthly_sales', function (Blueprint $table) {
            // Production & price columns - need 3+ decimals for tonnage
            $table->decimal('mining_price', 20, 5)->default(0)->change();
            $table->decimal('mining_production', 20, 5)->default(0)->change();
            $table->decimal('crusher_price', 20, 5)->default(0)->change();
            $table->decimal('crusher_production', 20, 5)->default(0)->change();
            $table->decimal('produksi_ppn', 20, 5)->default(0)->change();

            // Sewa columns - still large rupiah values but allow decimals just in case
            $table->decimal('sewa_loader', 20, 5)->default(0)->change();
            $table->decimal('sewa_dump_truck', 20, 5)->default(0)->change();
            $table->decimal('sewa_sany', 20, 5)->default(0)->change();
            $table->decimal('sewa_hyundai_220', 20, 5)->default(0)->change();
            $table->decimal('sewa_hyundai_330', 20, 5)->default(0)->change();
            $table->decimal('spare_part', 20, 5)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_sales', function (Blueprint $table) {
            $table->decimal('mining_price', 15, 2)->default(0)->change();
            $table->decimal('mining_production', 15, 2)->default(0)->change();
            $table->decimal('crusher_price', 15, 2)->default(0)->change();
            $table->decimal('crusher_production', 15, 2)->default(0)->change();
            $table->decimal('produksi_ppn', 15, 2)->default(0)->change();
            $table->decimal('sewa_loader', 15, 2)->default(0)->change();
            $table->decimal('sewa_dump_truck', 15, 2)->default(0)->change();
            $table->decimal('sewa_sany', 15, 2)->default(0)->change();
            $table->decimal('sewa_hyundai_220', 15, 2)->default(0)->change();
            $table->decimal('sewa_hyundai_330', 15, 2)->default(0)->change();
            $table->decimal('spare_part', 15, 2)->default(0)->change();
        });
    }
};
