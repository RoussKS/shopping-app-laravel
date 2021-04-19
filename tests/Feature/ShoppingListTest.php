<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function test_guest_user_cannot_create_shopping_list(): void
    {
        $response = $this->post('shopping-lists/');

        $response->assertRedirect('/login');

        $this->assertDatabaseCount('shopping_lists', 0);
    }

    public function test_authenticated_user_can_create_shopping_list(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        // Visit dashboard first where the post request will be available.
        $this->get('dashboard');

        $response = $this->post('shopping-lists');

        $response->assertRedirect('dashboard');

        $response->assertSessionHasNoErrors();

        $response->assertSessionHas('status', 'Successfully created Shopping List');
    }

    public function test_authenticated_user_can_not_create_more_than_one_shopping_list(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        // Visit dashboard first where the post request will be available.
        $this->get('dashboard');

        // Create first shopping list.
        $this->post('shopping-lists');

        // Attempt to create second second shopping list.
        $secondResponse = $this->post('shopping-lists');

        // Expect to fail with 403.
        $secondResponse->assertForbidden();
    }
}
