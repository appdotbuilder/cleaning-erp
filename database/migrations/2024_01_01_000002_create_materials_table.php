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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->string('unit')->comment('Unit of measurement (kg, pcs, liter, etc.)');
            $table->decimal('unit_cost', 15, 2)->default(0);
            $table->decimal('current_stock', 15, 2)->default(0);
            $table->decimal('minimum_stock', 15, 2)->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->index('name');
            $table->index('sku');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};