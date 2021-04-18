<?php

namespace App\Providers;

use App\Models\ShoppingItem;
use App\Models\ShoppingList;
use App\Models\User;
use App\Observers\ShoppingItemObserver;
use App\Observers\ShoppingListObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        ShoppingItem::observe(ShoppingItemObserver::class);
        ShoppingList::observe(ShoppingListObserver::class);
        User::observe(UserObserver::class);
    }
}
