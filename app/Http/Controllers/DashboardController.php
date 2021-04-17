<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Services\ShoppingListServiceContract;
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
     * The Shopping List service implementation.
     *
     * @var \App\Contracts\Services\ShoppingListServiceContract
     */
    protected $shoppingListService;

    /**
     * @var \App\ViewModels\ShoppingListViewModel
     */
    protected $shoppingListViewModel;

    /**
     * @var \App\ViewModels\UserViewModel
     */
    protected $userViewModel;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(
        ShoppingListServiceContract $shoppingListService,
        ShoppingListViewModel $shoppingListViewModel,
        UserViewModel $userViewModel,
        Request $request
    ) {
        $this->shoppingListService = $shoppingListService;
        $this->shoppingListViewModel = $shoppingListViewModel;
        $this->userViewModel = $userViewModel;
        $this->request = $request;
    }

    public function __invoke()
    {
        /** @var \App\Models\User $user */
        $user = $this->request->user();

        // Set the user view model.
        $this->userViewModel->setAttributes($user->toArray());

        // Get a shopping list for if it exists. By design, currently each user can only have 1 shopping list.
        $shoppingList = $this->shoppingListService->getFirstByUserId($user->id);

        // Set the shopping list view model.
        $this->shoppingListViewModel->setAttributes($shoppingList === null ? [] : $shoppingList->toArray());

        return view('dashboard')->with(
            [
                'user' => $this->userViewModel,
                'shoppingList' => $shoppingList === null ? null : $this->shoppingListViewModel
            ]
        );
    }
}
