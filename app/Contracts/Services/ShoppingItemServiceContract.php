<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\InputModels\ShoppingItemInputModel;
use App\Models\ShoppingItem;

/**
 * Interface ShoppingItemServiceContract
 *
 * @package App\Contracts\Services
 */
interface ShoppingItemServiceContract
{
    /**
     * @param  int $shoppingListId
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllByShoppingListId(int $shoppingListId);

    /**
     * Create a new Shopping Item.
     *
     * @param  \App\InputModels\ShoppingItemInputModel $inputModel
     *
     * @return \App\Models\ShoppingItem
     */
    public function create(ShoppingItemInputModel $inputModel): ShoppingItem;
}
