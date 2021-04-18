<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Services\ShoppingItemServiceContract;
use App\Http\Requests\ShoppingItem\ShoppingItemStoreRequest;
use App\InputModels\ShoppingItemInputModel;
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
     * @param  \App\Models\ShoppingList $shoppingList
     * @param  \App\Http\Requests\ShoppingItem\ShoppingItemStoreRequest $request
     * @param  \App\InputModels\ShoppingItemInputModel $inputModel
     * @param  \Illuminate\Routing\Redirector $redirector
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(
        ShoppingList $shoppingList,
        ShoppingItemStoreRequest $request,
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
