<?php

namespace Database\Seeders;

use App\Models\EvidenceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvidenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EvidenceType::create(['name' => 'Dokumen']);
        EvidenceType::create(['name' => 'Foto']);
        EvidenceType::create(['name' => 'Video']);
        EvidenceType::create(['name' => 'Audio']);
        EvidenceType::create(['name' => 'Lainnya']);
    }
}
