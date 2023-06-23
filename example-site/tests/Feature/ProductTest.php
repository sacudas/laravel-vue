<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();

        $response = $this
        ->actingAs($user)
        ->get('products')
        ->assertInertia(fn (Assert $page) => $page
        ->component('Products/Index')
        ->has('products'));
        $response->assertOk();
    }

    public function test_create_product(): void
    {
        $faker = Faker::create();
        $user = User::factory()->create();

        $data = [
            'name' => $faker->word,
        ];

        $response = $this
            ->actingAs($user)
            ->post('products', $data);

        $this->assertTrue($user->products->count() > 0);

        $response->assertStatus(302)
        ->assertSessionHasNoErrors();

    }
}
