<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id
 * @property integer $count
 * @property integer $user_id
 * @property integer $baking_type_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Bake extends Model
{
    use HasFactory;

    protected $table = 'bakes';

    protected $fillable = [
        'count',
        'user_id',
        'baking_type_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bakingType(): BelongsTo
    {
        return $this->belongsTo(BakingType::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
