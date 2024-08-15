<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'trip_num' => $this->faker->numberBetween(100,1000),
            'date' => $this->faker->date,
            'start_trip' => $this->faker->time(),
            'end_trip' =>$this->faker->time(),
            'status' => $this->faker->randomElement(['Done','Progress','Wait']),
            'available_chair' => $this->faker->numberBetween(35-40),
            'trip_type' =>$this->faker->randomElement(["scheduled","exceptional"]),
            'cost' => $this->faker->numberBetween(35000,40000),
            'Driver_id' => $this->faker->numberBetween(1, 50),
            'Bus_id' => $this->faker->numberBetween(1, 50) ,
            'From_To_id' => $this->faker->numberBetween(1, 4) ,
            'Branch_id' => $this->faker->numberBetween(1, 2) ,

        ];
    }
}
