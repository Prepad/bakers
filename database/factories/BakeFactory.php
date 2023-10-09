<?php

namespace Database\Factories;

use App\Models\BakingType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bake>
 */
class BakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'count' => intval(fake()->randomFloat(null, 20, 50)),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'baking_type_id' => BakingType::query()->inRandomOrder()->first()->id,
        ];
    }
}
