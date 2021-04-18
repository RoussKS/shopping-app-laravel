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

    /**
     * Delete a Shopping Item.
     * As Route model binding resolves to the model, no need to re-query, so use the model directly.
     *
     * @param  \App\Models\ShoppingItem $shoppingItem
     *
     * @return bool
     */
    public function delete(ShoppingItem $shoppingItem): bool;

    /**
     * Update a shopping item.
     *
     * @param  \App\Models\ShoppingItem $shoppingItem
     * @param  \App\InputModels\ShoppingItemInputModel $inputModel
     *
     * @return \App\Models\ShoppingItem
     */
    public function update(ShoppingItem $shoppingItem, ShoppingItemInputModel $inputModel): ShoppingItem;
}
