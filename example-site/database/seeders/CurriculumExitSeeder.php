<?php

namespace Database\Seeders;

use App\Models\CurriculumExit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumExitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurriculumExit::create(['name' => 'College Education']);
        CurriculumExit::create(['name' => 'Employment']);
        CurriculumExit::create(['name' => 'Entrepreneurship/Business']);
        CurriculumExit::create(['name' => 'Middle Level Skills Development']);
    }
}
