<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materials = [
            ['name' => 'Plastic Handle', 'unit' => 'pcs'],
            ['name' => 'Stainless Steel Rod', 'unit' => 'kg'],
            ['name' => 'Rubber Grip', 'unit' => 'pcs'],
            ['name' => 'Synthetic Bristles', 'unit' => 'kg'],
            ['name' => 'Chemical Cleaning Agent', 'unit' => 'liter'],
            ['name' => 'Aluminum Frame', 'unit' => 'pcs'],
            ['name' => 'Microfiber Cloth', 'unit' => 'm2'],
            ['name' => 'Wooden Handle', 'unit' => 'pcs'],
        ];

        $material = fake()->randomElement($materials);
        $unitCost = fake()->randomFloat(2, 5, 500);
        $currentStock = fake()->randomFloat(2, 10, 1000);
        $minimumStock = $currentStock * 0.2;

        return [
            'name' => $material['name'],
            'sku' => 'MAT-' . fake()->unique()->numerify('####'),
            'description' => fake()->sentence(),
            'unit' => $material['unit'],
            'unit_cost' => $unitCost,
            'current_stock' => $currentStock,
            'minimum_stock' => $minimumStock,
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the material is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the material has low stock.
     */
    public function lowStock(): static
    {
        return $this->state(function (array $attributes) {
            $minimumStock = fake()->randomFloat(2, 50, 100);
            return [
                'current_stock' => fake()->randomFloat(2, 1, $minimumStock * 0.5),
                'minimum_stock' => $minimumStock,
            ];
        });
    }
}