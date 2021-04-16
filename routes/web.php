<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/**
 * ShoppingList
 *
 * Post (Store)
 * Get (View)
 */
Route::prefix('shopping-lists')->middleware(['auth'])->group(function () {
    Route::post('/', [ShoppingListController::class, 'store']);
});

require __DIR__. '/auth.php';
