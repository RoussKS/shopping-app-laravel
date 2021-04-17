<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ShoppingListPolicy
 *
 * @package App\Policies
 */
class ShoppingListPolicy
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
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     *
     * @return bool
     */
    public function view(User $user, ShoppingList $shoppingList): bool
    {
        return $user->id === $shoppingList->user->id;
    }

    /**
     * Determine whether the user can create models.
     * Can only create/have 1 list each time.
     *
     * @param  \App\Models\User  $user
     *
     * @return  bool
     */
    public function create(User $user): bool
    {
        return $user->shoppingList()->first() === null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     *
     * @return bool
     */
    public function update(User $user, ShoppingList $shoppingList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     *
     * @return bool
     */
    public function delete(User $user, ShoppingList $shoppingList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     *
     * @return bool
     */
    public function restore(User $user, ShoppingList $shoppingList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     *
     * @return bool
     */
    public function forceDelete(User $user, ShoppingList $shoppingList): bool
    {
        return false;
    }
}
