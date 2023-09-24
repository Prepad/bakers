<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $abstract_baking_type_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class BakingType extends Model
{
    use HasFactory;

    protected $table = 'baking_types';

    protected $fillable = [
        'name',
        'user_id',
        'abstract_baking_type_id',
    ];

    public function bakes(): HasMany
    {
        return $this->hasMany(Bake::class);
    }

    public function abstractBakeType(): BelongsTo
    {
        return $this->belongsTo(AbstractBakingType::class);
    }

}
