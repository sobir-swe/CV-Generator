<?php

namespace Database\Seeders;

use App\Models\Links;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;

class LinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Links::factory()->count(10)->create();
    }
}
