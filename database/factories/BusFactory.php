<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "bus_name" => fake()->company(),
            "model" => fake()->name,
            "type" => "Vip",
            "bus_number" => fake()->numberBetween(10000,100000),
            "chair_count" => fake()->numberBetween(35,40),
            "form_type" => "A",
            "Branch_id"=> fake()->numberBetween(1,2)
        ];
    }
}
