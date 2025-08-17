<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'pic' => fake()->name(),
            'npwp' => fake()->numerify('##.###.###.#-###.###'),
            'discount_percentage' => fake()->randomFloat(2, 0, 15),
            'payment_terms_days' => fake()->randomElement([7, 14, 30, 45, 60]),
            'map_link' => fake()->url(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the supplier is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}