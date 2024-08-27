<?php

namespace Database\Seeders;

use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusType::create(['name' => 'Terbukti']);
        StatusType::create(['name' => 'Restorative Justice']);
        StatusType::create(['name' => 'Tidak Terbukti']);
    }
}
