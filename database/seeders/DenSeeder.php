<?php

namespace Database\Seeders;

use App\Models\Den;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Den::create(['name' => 'DEN A']);
        Den::create(['name' => 'DEN B']);
        Den::create(['name' => 'DEN C']);
    }
}
