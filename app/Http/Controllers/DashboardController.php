<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Services\ShoppingItemServiceContract;
use App\Contracts\Services\ShoppingListServiceContract;
use App\Models\ShoppingItem;
use App\Models\ShoppingList;
use App\ViewModels\ShoppingItemViewModel;
use App\ViewModels\ShoppingListViewModel;
use App\ViewModels\UserViewModel;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * The Shopping Item service implementation.
     *
     * @var \App\Contracts\Services\ShoppingItemServiceContract
     */
    protected $shoppingItemService;

    /**
     * The Shopping List service implementation.
     *
     * @var \App\Contracts\Services\ShoppingListServiceContract
     */
    protected $shoppingListService;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * DashboardController constructor.
     *
     * @param \App\Contracts\Services\ShoppingItemServiceContract $shoppingItemService
     * @param \App\Contracts\Services\ShoppingListServiceContract $shoppingListService
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function __construct(
        ShoppingItemServiceContract $shoppingItemService,
        ShoppingListServiceContract $shoppingListService,
        Request $request
    ) {
        $this->shoppingItemService = $shoppingItemService;
        $this->shoppingListService = $shoppingListService;
        $this->request = $request;
    }

    /**
     * @param \App\ViewModels\ShoppingListViewModel $shoppingListViewModel
     * @param \App\ViewModels\ShoppingItemViewModel $shoppingItemViewModel
     * @param \App\ViewModels\UserViewModel $userViewModel
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(
        ShoppingListViewModel $shoppingListViewModel,
        ShoppingItemViewModel $shoppingItemViewModel,
        UserViewModel $userViewModel
    ) {
        /** @var \App\Models\User $user */
        $user = $this->request->user();

        // Set the user view model.
        $userViewModel->setAttributes($user->toArray());

        // Get a shopping list for if it exists. By design, currently each user can only have 1 shopping list.
        $shoppingList = $this->shoppingListService->getFirstByUserId($user->id);

        // Set the shopping list view model if not null.
        $shoppingListViewModel->setAttributes($shoppingList === null ? [] : $shoppingList->toArray());

        return view('dashboard')->with(
            [
                'user' => $userViewModel,
                'shoppingList' => $shoppingList === null ? null : $shoppingListViewModel,
                // If not null shopping List
                'shoppingItems' => $shoppingList === null ? collect() : $this->getShoppingItemsViewModelCollection(
                    $shoppingList,
                    $shoppingItemViewModel
                )
            ]
        );
    }

    /**
     * @param  \App\Models\ShoppingList $shoppingList
     * @param  \App\ViewModels\ShoppingItemViewModel $shoppingItemViewModel
     *
     * @return \Illuminate\Support\Collection|\App\ViewModels\ShoppingItemViewModel[]
     */
    protected function getShoppingItemsViewModelCollection(
        ShoppingList $shoppingList,
        ShoppingItemViewModel $shoppingItemViewModel
    ) {
        $shoppingItemsViewModelCollection = collect();

        $shoppingItems = $this->shoppingItemService->getAllByShoppingListId($shoppingList->id);

        // if no shopping items on shopping list, return empty collection.
        if ($shoppingItems->isEmpty()) {
            return $shoppingItemsViewModelCollection;
        }

        // Loop through shopping item models and relevant view models to collection
        $shoppingItems->each(
            function (ShoppingItem $shoppingItem) use ($shoppingItemsViewModelCollection, $shoppingItemViewModel) {
                $shoppingItemViewModel->nullify();
                $shoppingItemViewModel->setAttributes($shoppingItem->toArray());
                $shoppingItemsViewModelCollection->add($shoppingItemViewModel);
            }
        );

        return $shoppingItemsViewModelCollection;
    }
}
