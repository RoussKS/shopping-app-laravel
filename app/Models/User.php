<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property \Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\Models\ShoppingList $shoppingList
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * @inheritdoc
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @inheritdoc
     *
     * @var string
     */
    public $keyType = 'string';

    /**
     * @inheritdoc
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @inheritdoc
     *
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'uuid' => 'string',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|\App\Models\ShoppingList
     */
    public function shoppingList()
    {
        return $this->hasOne(ShoppingList::class, 'user_id', 'id');
    }
}
