<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tickets_num' => $this->faker->numberBetween(100,1000),
            'first_name' => $this->faker->firstName,
            'mid_name' => $this->faker->lastName,
            'last_name' =>$this->faker->lastName,
            'chair_num' =>$this->faker->numberBetween(1,40),
            'is_used' => $this->faker->boolean,
            'presence_travellet' => $this->faker->boolean,
            'age' => $this->faker->numberBetween(1,99),
            'Booking_id' => $this->faker->numberBetween(1,50),
        ];
    }
}
