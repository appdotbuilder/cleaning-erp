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
        Schema::create('production_records', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number')->unique();
            $table->foreignId('finished_good_id')->constrained()->cascadeOnDelete();
            $table->date('production_date');
            $table->decimal('quantity_produced', 15, 2);
            $table->decimal('total_material_cost', 15, 2)->default(0);
            $table->decimal('labor_cost', 15, 2)->default(0);
            $table->decimal('overhead_cost', 15, 2)->default(0);
            $table->decimal('total_production_cost', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('batch_number');
            $table->index('finished_good_id');
            $table->index('production_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_records');
    }
};