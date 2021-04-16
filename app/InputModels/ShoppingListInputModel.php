<?php

namespace App\InputModels;

use Jenssegers\Model\Model;

/**
 * Class ShoppingListInputModel
 *
 * @package App\InputModels
 *
 * @property int $user_id
 */
class ShoppingListInputModel extends Model
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'user_id' => 'int'
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
