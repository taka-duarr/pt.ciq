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
        Schema::create('financial_years', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique();
            $table->timestamps();
        });

        Schema::create('monthly_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_year_id')->constrained('financial_years')->onDelete('cascade');
            $table->integer('month'); // 1 to 12
            
            // Mining (Tambang)
            $table->decimal('mining_price', 15, 2)->default(0);
            $table->decimal('mining_production', 15, 2)->default(0);
            
            // Stone Crusher
            $table->decimal('crusher_price', 15, 2)->default(0);
            $table->decimal('crusher_production', 15, 2)->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_sales');
        Schema::dropIfExists('financial_years');
    }
};
