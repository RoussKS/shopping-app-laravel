<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ShoppingItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ShoppingItemPolicy
 *
 * @package App\Policies
 */
class ShoppingItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * Only if the shopping list belongs to the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingItem  $shoppingItem
     *
     * @return bool
     */
    public function view(User $user, ShoppingItem $shoppingItem): bool
    {
        return $user->id === $shoppingItem->shoppingList->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     *
     * @return  bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * Only if the shopping item is in a shopping list that belongs to the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingItem  $shoppingItem
     *
     * @return bool
     */
    public function update(User $user, ShoppingItem $shoppingItem): bool
    {
        return $user->id === $shoppingItem->shoppingList->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * Only if the shopping item is in a shopping list that belongs to the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingItem  $shoppingItem
     *
     * @return bool
     */
    public function delete(User $user, ShoppingItem $shoppingItem): bool
    {
        return $user->id === $shoppingItem->shoppingList->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * Only if the shopping item is in a shopping list that belongs to the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingItem  $shoppingItem
     *
     * @return bool
     */
    public function restore(User $user, ShoppingItem $shoppingItem): bool
    {
        return $user->id === $shoppingItem->shoppingList->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * Only if the shopping item is in a shopping list that belongs to the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingItem  $shoppingItem
     *
     * @return bool
     */
    public function forceDelete(User $user, ShoppingItem $shoppingItem): bool
    {
        return $user->id === $shoppingItem->shoppingList->user_id;
    }
}
