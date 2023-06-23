<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(AdminPermissionSeeder::class);
        $this->call(AdminSeeder::class);

        $this->call(SectionSeeder::class);
        $this->call(TrackSeeder::class);
        $this->call(CurriculumSeeder::class);

        $this->call(CurriculumExitSeeder::class);
        $this->call(\Lwwcas\LaravelCountries\Database\Seeders\LcDatabaseSeeder::class);
    }
}
