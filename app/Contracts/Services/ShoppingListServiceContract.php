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
     * Get all Shopping Lists for a user.
     *
     * @param  int $userId
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\ShoppingList[]
     */
    public function getAllByUserId(int $userId);

    /**
     * Create a new Shopping List
     *
     * @param  \App\InputModels\ShoppingListInputModel $inputModel
     *
     * @return \App\Models\ShoppingList
     */
    public function create(ShoppingListInputModel $inputModel): ShoppingList;
}
