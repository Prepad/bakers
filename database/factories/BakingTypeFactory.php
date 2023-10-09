<?php

namespace Database\Factories;

use App\Models\AbstractBakingType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BakingType>
 */
class BakingTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'abstract_baking_type_id' => AbstractBakingType::query()->inRandomOrder()->first()->id,
        ];
    }
}
