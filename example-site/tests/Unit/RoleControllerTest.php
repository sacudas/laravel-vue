<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use App\Models\User;
use Tests\TestCase as TestCase;


it('should show a list of roles', function () {
        $user = User::factory()->create();

        $this
        ->actingAs($user)
        ->get('roles')
        ->assertInertia(fn (Assert $page) => $page
            ->component('Roles/Index')
            ->has('roles')
        );
});



it('can create roles', function(){
    expect(true)->toBeTrue();
});



