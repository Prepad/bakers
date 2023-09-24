<?php

namespace Database\Seeders;

use App\Models\AbstractBakingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbstractBakingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AbstractBakingType::create(['name' => 'bun']);
        AbstractBakingType::create(['name' => 'cake']);
        AbstractBakingType::create(['name' => 'pie']);
        AbstractBakingType::create(['name' => 'cupcake']);
        AbstractBakingType::create(['name' => 'bread']);
    }
}
