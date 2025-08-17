<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Supplier;
use App\Models\Material;
use App\Models\FinishedGood;
use App\Models\PurchaseOrder;
use App\Models\ProductionRecord;
use App\Models\SalesOrder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create sample data for ERP system
        Supplier::factory(15)->active()->create();
        Supplier::factory(3)->create(); // Some inactive suppliers
        
        Material::factory(20)->active()->create();
        Material::factory(5)->lowStock()->create(); // Low stock materials
        Material::factory(3)->create(); // Some inactive materials
        
        FinishedGood::factory(12)->active()->create();
        FinishedGood::factory(3)->lowStock()->create(); // Low stock finished goods
        FinishedGood::factory(2)->create(); // Some inactive finished goods
        
        PurchaseOrder::factory(25)->create();
        ProductionRecord::factory(30)->create();
        SalesOrder::factory(20)->create();
    }
}
