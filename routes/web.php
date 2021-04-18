<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShoppingItemController;
use App\Http\Controllers\ShoppingListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Generic Routes
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

/**
 * ShoppingList
 *
 * Post (Store)
 * Get (View)
 */
Route::prefix('shopping-lists')->middleware(['auth'])->group(function () {
    Route::post('', [ShoppingListController::class, 'store'])->name('shopping-lists.store');

    // Actions routed by specific shopping list
    Route::prefix('/{shopping_list}')->group(function () {
        /*
         * Shopping Item routes
         *
         * POST: shopping-lists/{shopping-list}/shopping-item
         * PATCH: shopping-lists/{shopping-list}/shopping-item/{shopping-item}
         * DELETE: shopping-lists/{shopping-list}/shopping-item/{shopping-item}
         */
        Route::post(
            '/shopping-item',
            [ShoppingItemController::class, 'store']
        )->name('shopping-items.store');
        Route::delete(
            '/shopping-item',
            [ShoppingItemController::class, 'destroy']
        )->name('shopping-items.destroy');
    });
});

require __DIR__. '/auth.php';
