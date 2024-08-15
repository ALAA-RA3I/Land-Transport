<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function Sodium\increment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "User_id" => null,
            "Manager_id" => 2,
            "date_of_booking" => $this->faker->date,
            "Trip_id" => fake()->numberBetween(5,48),
            "Booking_type" => $this->faker->randomElement( ["Electronic","Manual"]),
            "Branch_id" => fake()->numberBetween(1,2),
            "charge_id" => fake()->numberBetween(1500,5000)
        ];
    }
}
