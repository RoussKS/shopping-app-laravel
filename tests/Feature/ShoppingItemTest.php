<?php

namespace Tests\Feature;

use App\Models\ShoppingItem;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Class ShoppingItemTest
 *
 * @package Tests\Feature
 */
class ShoppingItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_users_can_add_items_to_their_shopping_list(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        /** @var \App\Models\ShoppingList $shoppingList */
        $shoppingList = ShoppingList::factory()->create(
            [
                'user_id' => $user->id
            ]
        );

        $this->actingAs($user);

        // Visit dashboard first where the post request will be available.
        $this->get('dashboard');

        $shoppingItemName = Str::random(8);

        $response = $this->post(
            'shopping-lists/' . $shoppingList->uuid . '/shopping-items',
            [
                'shopping_item_name' => $shoppingItemName
            ]
        );

        $shoppingItems = $shoppingList->shoppingItems->all();

        // Shopping list should have at least one items.
        self::assertNotEmpty($shoppingItems);
        self::assertCount(1, $shoppingItems);

        $response->assertSessionHasNoErrors();

        $response->assertSessionHas('status', 'Successfully added Item to the Shopping List');
    }

    public function test_authenticated_users_cannot_add_items_to_other_users_shopping_list(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        /** @var \App\Models\ShoppingList $shoppingList */
        $shoppingList = ShoppingList::factory()->create(
            [
                'user_id' => $user->id
            ]
        );

        /** @var \App\Models\User $anotherUser */
        $anotherUser = User::factory()->create();

        // Login and act as second user.
        $this->actingAs($anotherUser);

        // Visit dashboard first where the post request will be available.
        $this->get('dashboard');

        $shoppingItemName = Str::random(8);

        $response = $this->post(
            'shopping-lists/' . $shoppingList->uuid . '/shopping-items',
            [
                'shopping_item_name' => $shoppingItemName
            ]
        );

        // Expect to fail with 403.
        $response->assertForbidden();

        // Shopping list should not have any items.
        self::assertEmpty($shoppingList->shoppingItems->all());
    }

    public function test_authenticated_users_can_mark_items_as_purchased_from_their_shopping_list(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        /** @var \App\Models\ShoppingList $shoppingList */
        $shoppingList = ShoppingList::factory()->create(
            [
                'user_id' => $user->id
            ]
        );

        /** @var \App\Models\ShoppingItem $shoppingItem */
        $shoppingItem = ShoppingItem::factory()->create(
            [
                'name' => Str::random(6),
                'shopping_list_id' => $shoppingList->id
            ]
        );

        // Assert attribute first.
        self::assertFalse($shoppingItem->is_purchased);

        $this->actingAs($user);

        // Visit dashboard first where the post request will be available.
        $this->get('dashboard');

        $response = $this->patch(
            'shopping-lists/' . $shoppingList->uuid . '/shopping-items/' . $shoppingItem->uuid,
            [
                'is_purchased' => 1,
            ]
        );

        // Refresh model after update.
        $shoppingItem->refresh();

        // Assert property has changed
        self::assertTrue($shoppingItem->is_purchased);

        $response->assertSessionHasNoErrors();

        $response->assertSessionHas('status', 'Successfully marked Item as purchased');
    }

    public function test_authenticated_users_cannot_mark_items_as_purchased_from_other_users_shopping_list(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        /** @var \App\Models\ShoppingList $shoppingList */
        $shoppingList = ShoppingList::factory()->create(
            [
                'user_id' => $user->id
            ]
        );

        /** @var \App\Models\ShoppingItem $shoppingItem */
        $shoppingItem = ShoppingItem::factory()->create(
            [
                'name' => Str::random(6),
                'shopping_list_id' => $shoppingList->id
            ]
        );

        /** @var \App\Models\User $anotherUser */
        $anotherUser = User::factory()->create();

        // Login and act as second user.
        $this->actingAs($anotherUser);

        // Visit dashboard first where the post request will be available.
        $this->get('dashboard');

        $response = $this->patch(
            'shopping-lists/' . $shoppingList->uuid . '/shopping-items/' . $shoppingItem->uuid,
            [
                'is_purchased' => 1,
            ]
        );

        // Refresh model after update.
        $shoppingItem->refresh();

        // Assert property has changed
        self::assertFalse($shoppingItem->is_purchased);

        $response->assertForbidden();
    }

    public function test_authenticated_users_can_delete_items_from_their_shopping_list(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        /** @var \App\Models\ShoppingList $shoppingList */
        $shoppingList = ShoppingList::factory()->create(
            [
                'user_id' => $user->id
            ]
        );

        /** @var \App\Models\ShoppingItem $shoppingItem */
        $shoppingItem = ShoppingItem::factory()->create(
            [
                'name' => Str::random(6),
                'shopping_list_id' => $shoppingList->id
            ]
        );

        $this->actingAs($user);

        // Visit dashboard first where the post request will be available.
        $this->get('dashboard');

        $response = $this->delete('shopping-lists/' . $shoppingList->uuid . '/shopping-items/' . $shoppingItem->uuid);

        $shoppingItems = $shoppingList->shoppingItems->all();

        // Shopping list should be empty.
        self::assertEmpty($shoppingItems);

        $response->assertSessionHasNoErrors();

        $response->assertSessionHas('status', 'Successfully deleted Item from the Shopping List');
    }

    public function test_authenticated_users_cannot_delete_items_from_other_users_shopping_list(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        /** @var \App\Models\ShoppingList $shoppingList */
        $shoppingList = ShoppingList::factory()->create(
            [
                'user_id' => $user->id
            ]
        );

        /** @var \App\Models\ShoppingItem $shoppingItem */
        $shoppingItem = ShoppingItem::factory()->create(
            [
                'name' => Str::random(6),
                'shopping_list_id' => $shoppingList->id
            ]
        );

        /** @var \App\Models\User $anotherUser */
        $anotherUser = User::factory()->create();

        // Login and act as second user.
        $this->actingAs($anotherUser);

        // Visit dashboard first where the post request will be available.
        $this->get('dashboard');

        $response = $this->delete('shopping-lists/' . $shoppingList->uuid . '/shopping-items/' . $shoppingItem->uuid);

        $response->assertForbidden();

        $shoppingItems = $shoppingList->shoppingItems->all();

        // Shopping list should be empty.
        self::assertNotEmpty($shoppingItems);
    }
}
