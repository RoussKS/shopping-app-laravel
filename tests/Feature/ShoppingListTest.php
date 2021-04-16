<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Class ShoppingListTest
 *
 * @package Tests\Feature
 */
class ShoppingListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws \Exception
     */
    public function test_guest_user_cannot_create_shopping_list()
    {
        $response = $this->post('shopping-lists/');

        $response->assertRedirect('/login');

        $this->assertDatabaseCount('shopping_lists', 0);
    }

    public function test_authenticated_user_can_create_shopping_list()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('shopping-lists');

        $this->assertDatabaseCount('shopping_lists', 1);
    }
}
