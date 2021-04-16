<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Services\ShoppingListServiceContract;
use App\Http\Requests\ShoppingList\ShoppingListStoreRequest;
use App\InputModels\ShoppingListInputModel;
use App\ViewModels\ShoppingListViewModel;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * Class ShoppingListController
 *
 * @package App\Http\Controllers
 */
class ShoppingListController extends Controller
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \App\Contracts\Services\ShoppingListServiceContract
     */
    protected $shoppingListService;

    /**
     * ShoppingListController constructor.
     *
     * @param  \Psr\Log\LoggerInterface $logger
     * @param  \App\Contracts\Services\ShoppingListServiceContract $shoppingListService
     *
     * @return void
     */
    public function __construct(LoggerInterface $logger, ShoppingListServiceContract $shoppingListService)
    {
        $this->logger = $logger;
        $this->shoppingListService = $shoppingListService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShoppingList\ShoppingListStoreRequest  $request
     * @param  \App\InputModels\ShoppingListInputModel  $inputModel
     * @param  \App\ViewModels\ShoppingListViewModel  $viewModel
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        ShoppingListStoreRequest $request,
        ShoppingListInputModel $inputModel,
        ShoppingListViewModel $viewModel
    ) {
        try {
            /** @var \App\Models\User $user */
            $user = $request->user();

            // Set Input Model properties.
            $inputModel->setAttributes(['user_id' => $user->id]);

            $shoppingList = $this->shoppingListService->create($inputModel);

            // Set View Model properties.
            $viewModel->setAttributes($shoppingList->toArray());
        } catch (Throwable $throwable) {
            $this->logger->critical($throwable->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        //
    }
}
