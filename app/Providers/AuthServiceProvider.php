<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\ShoppingItem;
use App\Models\ShoppingList;
use App\Policies\ShoppingItemPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\ShoppingListPolicy;

/**
 * Class AuthServiceProvider
 *
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ShoppingList::class => ShoppingListPolicy::class,
        ShoppingItem::class => ShoppingItemPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
