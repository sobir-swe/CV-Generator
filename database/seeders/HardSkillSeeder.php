<?php

namespace Database\Seeders;

use App\Models\HardSkill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HardSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HardSkill::factory()->count(10)->create();
    }
}
