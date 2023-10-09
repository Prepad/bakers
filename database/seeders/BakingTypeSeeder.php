<?php

namespace Database\Seeders;

use App\Models\BakingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BakingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BakingType::factory(10)->create();
    }
}
