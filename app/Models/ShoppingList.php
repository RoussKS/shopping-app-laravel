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
 */
class ShoppingList extends Model
{
    use HasFactory;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
