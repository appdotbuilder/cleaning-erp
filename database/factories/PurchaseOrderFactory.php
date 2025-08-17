<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderDate = fake()->dateTimeBetween('-6 months', 'now');
        $expectedDeliveryDate = fake()->dateTimeBetween($orderDate, '+1 month');
        $subtotal = fake()->randomFloat(2, 100, 10000);
        $discountAmount = $subtotal * fake()->randomFloat(2, 0, 0.15);
        $taxAmount = ($subtotal - $discountAmount) * 0.11; // 11% tax
        $totalAmount = $subtotal - $discountAmount + $taxAmount;

        return [
            'po_number' => 'PO-' . fake()->unique()->numerify('######'),
            'supplier_id' => Supplier::factory(),
            'order_date' => $orderDate,
            'expected_delivery_date' => $expectedDeliveryDate,
            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'status' => fake()->randomElement(['draft', 'sent', 'confirmed', 'delivered', 'cancelled']),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}