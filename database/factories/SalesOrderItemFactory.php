<?php

namespace Database\Factories;

use App\Models\FinishedGood;
use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesOrderItem>
 */
class SalesOrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->randomFloat(2, 1, 50);
        $unitPrice = fake()->randomFloat(2, 20, 500);
        $totalPrice = $quantity * $unitPrice;

        return [
            'sales_order_id' => SalesOrder::factory(),
            'finished_good_id' => FinishedGood::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}