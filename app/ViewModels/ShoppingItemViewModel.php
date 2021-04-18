<?php

declare(strict_types=1);

namespace App\ViewModels;

use Jenssegers\Model\Model;

/**
 * Class ShoppingItemViewModel
 *
 * @package App\ViewModels
 *
 * @property string $uuid
 * @property string $name
 * @property int $shopping_list_id
 * @property bool $is_purchased
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ShoppingItemViewModel extends Model
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'uuid',
        'name',
        'shopping_list_id',
        'is_purchased',
        'created_at',
        'updated_at',
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'uuid' => 'string',
        'name' => 'string',
        'shopping_list_id' => 'id',
        'is_purchased' => 'bool',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Set the attributes.
     *
     * @param  array $data
     *
     * @return void
     */
    public function setAttributes(array $data): void
    {
        foreach ($this->fillable as $attribute) {
            // If not found in input, go to next.
            if (!isset($data[$attribute])) {
                continue;
            }

            // Policy dictates who can change the Model on request, so we can replace user_id if allowed.
            $this->$attribute = $data[$attribute];
        }
    }

    /**
     * Set all attributes to null
     */
    public function nullify(): void
    {
        foreach ($this->fillable as $attribute) {
            $this->$attribute = null;
        }
    }
}
