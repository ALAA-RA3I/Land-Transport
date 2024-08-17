<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use phpseclib3\Crypt\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Fname' => $this->faker->firstName,
            'Lname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // or use Hash::make('password')
            'hire_date' => $this->faker->date(),
            'phone_number' => $this->faker->numberBetween(10000,20000),
            'birthday' => $this->faker->date(),
            'year_experince' => $this->faker->numberBetween(1, 40),
            'Branch_id' => $this->faker->numberBetween(1, 2) ,
        ];

    }
}
