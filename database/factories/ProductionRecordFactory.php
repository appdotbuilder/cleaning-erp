<?php

namespace Database\Factories;

use App\Models\FinishedGood;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductionRecord>
 */
class ProductionRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantityProduced = fake()->randomFloat(2, 10, 500);
        $totalMaterialCost = $quantityProduced * fake()->randomFloat(2, 5, 50);
        $laborCost = $quantityProduced * fake()->randomFloat(2, 2, 20);
        $overheadCost = ($totalMaterialCost + $laborCost) * fake()->randomFloat(2, 0.1, 0.3);
        $totalProductionCost = $totalMaterialCost + $laborCost + $overheadCost;

        return [
            'batch_number' => 'BATCH-' . fake()->unique()->numerify('######'),
            'finished_good_id' => FinishedGood::factory(),
            'production_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'quantity_produced' => $quantityProduced,
            'total_material_cost' => $totalMaterialCost,
            'labor_cost' => $laborCost,
            'overhead_cost' => $overheadCost,
            'total_production_cost' => $totalProductionCost,
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}