<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\InputModels\ShoppingListInputModel;
use App\Models\ShoppingList;

/**
 * Interface ShoppingListServiceContract
 *
 * @package App\Contracts\Services
 */
interface ShoppingListServiceContract
{
    /**
     * @param  int $userId
     *
     * @return \App\Models\ShoppingList|null
     */
    public function getFirstByUserId(int $userId): ?ShoppingList;

    /**
     * Create a new Shopping List
     *
     * @param  \App\InputModels\ShoppingListInputModel $inputModel
     *
     * @return \App\Models\ShoppingList
     */
    public function create(ShoppingListInputModel $inputModel): ShoppingList;
}
