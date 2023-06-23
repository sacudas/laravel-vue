<?php

namespace Tests\Unit;

use App\Models\Curriculum;
use App\Models\CurriculumExit;
use App\Models\Section;
use App\Models\Track;
use App\Models\User;
use Tests\TestCase;

class CurriculumTest extends TestCase
{

    /**
     * A basic unit test example.
     */
    public function test_store_curriculum(): void
    {
        $user = User::factory()->create();

        $user->assignRole('guest');

        $curriculum = new Curriculum;

        $track = Track::inRandomOrder()->first();

        $section = Section::inRandomOrder()->first();

        $curriculum_exit = CurriculumExit::inRandomOrder()->first();


        $curriculum->track()->associate($track);
        $curriculum->user()->associate($user);
        $curriculum->section()->associate($section);
        $curriculum->curriculum_exit()->associate($curriculum_exit);
        $curriculum->emmersion_company = fake()->company();
        $curriculum->empoyment_status = rand(1,2);

        $curriculum->save();

         // Assert that the data has been saved
         $this->assertDatabaseHas('curricula', [
            'user_id' => $user->id,
            'track_id' => $track->id
        ]);

    }
}
