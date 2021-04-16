<?php

namespace App\ViewModels;

use Jenssegers\Model\Model;

/**
 * Class ShoppingListViewModel
 *
 * @package App\ViewModels
 *
 * @property string $uuid
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ShoppingListViewModel extends Model
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'id' => 'int',
        'uuid' => 'string',
        'user_id' => 'id',
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
}
