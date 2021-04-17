<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class DeferrableServiceProvider
 *
 * @package App\Providers
 */
class DeferrableServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        'App\Contracts\Services\ShoppingListServiceContract' => 'App\Services\ShoppingListService',
        'App\Contracts\Services\ShoppingItemServiceContract' => 'App\Services\ShoppingItemService',
    ];

    /**
     * @inheritdoc
     */
    public function register()
    {
        foreach ($this->bindings as $contract => $implementation) {
            $this->app->bind($contract, $implementation);
        }
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
