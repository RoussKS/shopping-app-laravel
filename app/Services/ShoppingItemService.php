<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\ShoppingItemServiceContract;
use App\InputModels\ShoppingItemInputModel;
use App\Models\ShoppingItem;

/**
 * Class ShoppingItemService
 *
 * @package App\Services
 */
class ShoppingItemService implements ShoppingItemServiceContract
{
    /**
     * @inheritDoc
     */
    public function getAllByShoppingListId(int $shoppingListId)
    {
        return $this->query()->where(['shopping_list_id' => $shoppingListId])->get();
    }

    /**
     * @inheritDoc
     */
    public function create(ShoppingItemInputModel $inputModel): ShoppingItem
    {
        /** @var \App\Models\ShoppingItem $shoppingItem */
        $shoppingItem = $this->query()->create(
            [
                'name' => $inputModel->name,
                'shopping_list_id' => $inputModel->shopping_list_id,
                'is_purchased' => $inputModel->is_purchased
            ]
        );

        return $shoppingItem;
    }

    /**
     * @inheritDoc
     *
     * Cannot return false as we know the model exists.
     * Currently limited to mark as is_purchased.
     */
    public function update(ShoppingItem $shoppingItem, ShoppingItemInputModel $inputModel): ShoppingItem
    {
        $shoppingItem->update(
            [
                'is_purchased' => $inputModel->is_purchased
            ]
        );

        return $shoppingItem->refresh();
    }

    /**
     * @inheritDoc
     *
     * @throws \Exception
     */
    public function delete(ShoppingItem $shoppingItem): bool
    {
        return $shoppingItem->delete();
    }

    /**
     * Get a base ShoppingList Model Query.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingItem
     */
    protected function query()
    {
        return ShoppingItem::query();
    }
}
