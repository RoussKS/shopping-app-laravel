<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\ShoppingListServiceContract;
use App\InputModels\ShoppingListInputModel;
use App\Models\ShoppingList;

/**
 * Class ShoppingListService
 *
 * @package App\Services
 */
class ShoppingListService implements ShoppingListServiceContract
{
    public function getAllByUserId(int $userId)
    {
        // TODO: Implement getAllByUserId() method.
    }

    /**
     * @inheritDoc
     */
    public function create(ShoppingListInputModel $inputModel): ShoppingList
    {
        /** @var \App\Models\ShoppingList $shoppingList */
        $shoppingList = $this->query()->create(
            [
                'user_id' => $inputModel->user_id
            ]
        );

        return $shoppingList;
    }

    /**
     * Get a base ShoppingList Model Query.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\App\Models\ShoppingList
     */
    protected function query()
    {
        return ShoppingList::query();
    }
}
