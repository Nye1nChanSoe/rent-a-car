<?php

namespace Database\Factories;

use App\Enums\VehicleMake;
use App\Enums\VehicleStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'license_plate' => strtoupper(fake()->bothify('??-####')), # AB-1234,
            'make' => fake()->randomElement(VehicleMake::values()),
            'model' => fake()->word(),
            'year' => fake()->numberBetween(2010, 2025),
            'remarks' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(VehicleStatus::values()),
        ];
    }
}
