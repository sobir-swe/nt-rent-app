<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'user_id' => User::all()->random()->id,
            'status_id' => Status::all()->random()->id,
            'branch_id' => Branch::all()->random()->id,
            'address' => $this->faker->address(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'price' => $this->faker->numberBetween(50, 100000),
            'rooms' => $this->faker->randomDigit(),
        ];
    }
}
