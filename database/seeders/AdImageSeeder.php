<?php

namespace Database\Seeders;

use App\Models\AdImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdImage::factory()->count(10)->create();
    }
}
