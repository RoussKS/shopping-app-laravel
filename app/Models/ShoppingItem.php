<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShoppingItem
 *
 * @property int $id
 * @property string $uuid
 * @property int $shopping_list_id
 * @property bool $is_purchased
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\Models\ShoppingList $shoppingList
 *
 * @package App\Models
 */
class ShoppingItem extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'shopping_list_id',
        'is_purchased'
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'uuid' => 'string',
        'shopping_list_id' => 'int',
        'is_purchased' => 'bool'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\App\Models\ShoppingList
     */
    public function shoppingList()
    {
        return $this->belongsTo(ShoppingList::class);
    }
}
