<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShoppingList
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ShoppingItem[] $shoppingItems
 */
class ShoppingList extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'id' => 'int',
        'uuid' => 'string',
        'user_id' => 'int'
    ];

    /**
     * @inheritdoc
     *
     * Replace route model binding key name with UUID.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\App\Models\ShoppingItem[]
     */
    public function shoppingItems()
    {
        return $this->hasMany(ShoppingItem::class);
    }
}
