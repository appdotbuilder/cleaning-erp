<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinishedGood>
 */
class FinishedGoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            'Premium Toilet Brush',
            'Heavy Duty Floor Mop',
            'Multi-Surface Cleaning Wand',
            'Professional Window Squeegee',
            'Microfiber Cleaning Cloth Set',
            'Industrial Floor Scrubber',
            'Extendable Duster',
            'All-Purpose Cleaning Spray',
            'Kitchen Sponge Pack',
            'Car Wash Kit',
        ];

        $productionCost = fake()->randomFloat(2, 10, 150);
        $sellingPrice = $productionCost * fake()->randomFloat(2, 1.3, 2.5);
        $currentStock = fake()->randomFloat(2, 5, 500);
        $minimumStock = $currentStock * 0.15;

        return [
            'name' => fake()->randomElement($products),
            'sku' => 'FG-' . fake()->unique()->numerify('####'),
            'description' => fake()->sentence(),
            'selling_price' => $sellingPrice,
            'production_cost' => $productionCost,
            'current_stock' => $currentStock,
            'minimum_stock' => $minimumStock,
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the finished good is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the finished good has low stock.
     */
    public function lowStock(): static
    {
        return $this->state(function (array $attributes) {
            $minimumStock = fake()->randomFloat(2, 10, 50);
            return [
                'current_stock' => fake()->randomFloat(2, 1, $minimumStock * 0.5),
                'minimum_stock' => $minimumStock,
            ];
        });
    }
}