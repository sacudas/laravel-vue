<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use PhpParser\Builder\Function_;

class RoleTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_role_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
        ->actingAs($user)
        ->get('roles');

        $response->assertOk();

    }

    public function test_create_role_with_permission(): void
    {

        $faker = Faker::create();
        $permissions = Permission::get();
        $user = User::factory()->create();


        $user->assignRole('admin');

        $data = [
            'name' => $faker->word,
            'permissions' => $permissions->pluck('id')->random(3)
        ];

        $response = $this
            ->actingAs($user)
            ->post('roles', $data);

        $response->assertStatus(302)
        ->assertSessionHasNoErrors();

    }

    /**
     * Create a role from unauthorize user
     */
    public function test_create_role_with_permission_using_invalid_user_role(){
        $faker = Faker::create();
        $permissions = Permission::get();

        $user = User::factory()->create();

        $data = [
            'name' => $faker->word,
            'permissions' => $permissions->pluck('id')->random(3)
        ];

        $response = $this
            ->actingAs($user)
            ->post('roles', $data);

        $roleExists = Role::where('name', $data['name'])->exists();


        $this->assertFalse($roleExists);

        $response->assertForbidden()
        ->assertSessionHasNoErrors();
    }


    public function test_create_role_with_invalid_empty_permission(): void
    {

        $faker = Faker::create();
        $user = User::factory()->create();


        $user->assignRole('admin');

        $data = [
            'name' => $faker->word,
            'permissions' => []
        ];

        $response = $this
            ->actingAs($user)
            ->post('roles', $data);

        $response->assertSessionHasErrors([
            'permissions' => 'The permissions field is required.'
        ]);

    }


}
