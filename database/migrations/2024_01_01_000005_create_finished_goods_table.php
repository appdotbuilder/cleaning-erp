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
        Schema::create('finished_goods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->decimal('selling_price', 15, 2);
            $table->decimal('production_cost', 15, 2)->default(0);
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
        Schema::dropIfExists('finished_goods');
    }
};