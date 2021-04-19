<?php

namespace Database\Factories;

use App\Models\ShoppingItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class ShoppingItemFactory
 *
 * @package Database\Factories
 */
class ShoppingItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShoppingItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(8),
            'is_purchased' => false
        ];
    }
}
