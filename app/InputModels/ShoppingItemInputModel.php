<?php

declare(strict_types=1);

namespace App\InputModels;

use Jenssegers\Model\Model;

/**
 * Class ShoppingItemInputModel
 *
 * @package App\InputModels
 *
 * @property string $name
 * @property int $shopping_list_id
 * @property bool $is_purchased
 */
class ShoppingItemInputModel extends Model
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name',
        'shopping_list_id',
        'is_purchased'
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'name' => 'string',
        'shopping_list_id' => 'int',
        'is_purchased' => 'bool'
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
}
