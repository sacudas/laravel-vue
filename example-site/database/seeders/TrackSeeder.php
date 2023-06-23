<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Track::create(['name' => 'Academic Track -HUMMS']);
        Track::create(['name' => 'Technology and Vocational Livelihood Track']);
    }
}
