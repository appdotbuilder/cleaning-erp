<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrderItem>
 */
class PurchaseOrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->randomFloat(2, 1, 100);
        $unitPrice = fake()->randomFloat(2, 5, 200);
        $totalPrice = $quantity * $unitPrice;

        return [
            'purchase_order_id' => PurchaseOrder::factory(),
            'material_id' => Material::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}