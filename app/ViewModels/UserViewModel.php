<?php

namespace App\ViewModels;

use Jenssegers\Model\Model;

/**
 * Class ShoppingListViewModel
 *
 * @package App\ViewModels
 *
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property \Carbon\Carbon $email_verified_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class UserViewModel extends Model
{
    /**
     * @inheritdoc
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'uuid' => 'string',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
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
