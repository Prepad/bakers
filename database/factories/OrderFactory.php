<?php

namespace Database\Factories;

use App\Models\Bake;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bake = Bake::query()->inRandomOrder()->first();
        return [
            'count' => intval(fake()->randomFloat(null, 2, 5)),
            'bake_id' => $bake->id,
            'user_id' => $bake->user_id,
            'closed' => false,
        ];
    }
}
