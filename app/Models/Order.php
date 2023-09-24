<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id
 * @property integer $count
 * @property integer $bake_id
 * @property integer $user_id
 * @property boolean $closed
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'count',
        'bake_id',
        'closed',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bake(): BelongsTo
    {
        return $this->belongsTo(Bake::class);
    }
}
