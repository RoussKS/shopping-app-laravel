<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Services\ShoppingItemServiceContract;
use App\Http\Requests\ShoppingItem\ShoppingItemDestroyRequest;
use App\Http\Requests\ShoppingItem\ShoppingItemStoreRequest;
use App\Http\Requests\ShoppingItem\ShoppingItemUpdateRequest;
use App\InputModels\ShoppingItemInputModel;
use App\Models\ShoppingItem;
use App\Models\ShoppingList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * Class ShoppingItemController
 *
 * @package App\Http\Controllers
 */
class ShoppingItemController extends Controller
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * The Shopping Item service contract implementation.
     *
     * @var \App\Contracts\Services\ShoppingItemServiceContract
     */
    protected $shoppingItemService;

    /**
     * ShoppingItemController constructor.
     *
     * @param  \Psr\Log\LoggerInterface $logger
     * @param  \App\Contracts\Services\ShoppingItemServiceContract $shoppingItemService
     *
     * @return void
     */
    public function __construct(LoggerInterface $logger, ShoppingItemServiceContract $shoppingItemService)
    {
        $this->logger = $logger;
        $this->shoppingItemService = $shoppingItemService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShoppingItem\ShoppingItemStoreRequest $request
     * @param  \App\Models\ShoppingList $shoppingList
     * @param  \App\InputModels\ShoppingItemInputModel $inputModel
     * @param  \Illuminate\Routing\Redirector $redirector
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(
        ShoppingItemStoreRequest $request,
        ShoppingList $shoppingList,
        ShoppingItemInputModel $inputModel,
        Redirector $redirector
    ): RedirectResponse {
        try {
            $requestInput = $request->validated();

            $inputModel->setAttributes(
                [
                    'name' => $requestInput['shopping_item_name'],
                    'shopping_list_id' => $shoppingList->id,
                    'is_purchased' => false // When created, should not already been purchased.
                ]
            );

            $this->shoppingItemService->create($inputModel);

            return $redirector->back()->with(
                [
                    'message' => 'Successfully added Item to the Shopping List'
                ]
            );
        } catch (Throwable $throwable) {
            $this->logger->critical($throwable->getMessage());

            return $redirector->back()->withErrors(
                [
                    'Could not add Item to the Shopping List'
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \App\Http\Requests\ShoppingItem\ShoppingItemUpdateRequest $request
     * @param   \App\Models\ShoppingList $shoppingList
     * @param   \App\Models\ShoppingItem $shoppingItem
     * @param  \App\InputModels\ShoppingItemInputModel $inputModel
     * @param   \Illuminate\Routing\Redirector $redirector
     *
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function update(
        ShoppingItemUpdateRequest $request,
        ShoppingList $shoppingList,
        ShoppingItem $shoppingItem,
        ShoppingItemInputModel $inputModel,
        Redirector $redirector
    ): RedirectResponse {
        try {
            $requestInput = $request->validated();

            $inputModel->setAttributes(
                [
                    'name' => $shoppingItem->name,
                    'shopping_list_id' => $shoppingItem->shopping_list_id,
                    'is_purchased' => $requestInput['is_purchased']
                ]
            );

            $this->shoppingItemService->update($shoppingItem, $inputModel);

            // Redirect with message on success.
            return $redirector->back()->with(
                [
                    'message' => 'Successfully deleted Item from the Shopping List'
                ]
            );
        } catch (Throwable $throwable) {
            $this->logger->critical($throwable->getMessage());

            return $redirector->back()->withErrors(
                [
                    'Could not mark the Shopping Item as purchased'
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   \App\Http\Requests\ShoppingItem\ShoppingItemDestroyRequest $request
     * @param   \App\Models\ShoppingList $shoppingList
     * @param   \App\Models\ShoppingItem $shoppingItem
     * @param   \Illuminate\Routing\Redirector $redirector
     *
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function destroy(
        ShoppingItemDestroyRequest $request,
        ShoppingList $shoppingList,
        ShoppingItem $shoppingItem,
        Redirector $redirector
    ): RedirectResponse {
        try {
            // Redirect with message on success.
            if ($this->shoppingItemService->delete($shoppingItem)) {
                return $redirector->back()->with(
                    [
                        'message' => 'Successfully deleted Item from the Shopping List'
                    ]
                );
            }

            // If failed, redirect with errors.
            return $redirector->back()->withErrors(
                [
                    'Could not delete Item from the Shopping List'
                ]
            );
        } catch (Throwable $throwable) {
            $this->logger->critical($throwable->getMessage());

            return $redirector->back()->withErrors(
                [
                    'Could not delete Item from the Shopping List'
                ]
            );
        }
    }
}
