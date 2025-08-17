<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderDate = fake()->dateTimeBetween('-3 months', 'now');
        $deliveryDate = fake()->dateTimeBetween($orderDate, '+2 weeks');
        $subtotal = fake()->randomFloat(2, 200, 15000);
        $taxAmount = $subtotal * 0.11; // 11% tax
        $totalAmount = $subtotal + $taxAmount;

        return [
            'so_number' => 'SO-' . fake()->unique()->numerify('######'),
            'customer_name' => fake()->company(),
            'customer_address' => fake()->address(),
            'customer_phone' => fake()->phoneNumber(),
            'order_date' => $orderDate,
            'delivery_date' => $deliveryDate,
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'status' => fake()->randomElement(['draft', 'confirmed', 'shipped', 'delivered', 'cancelled']),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}