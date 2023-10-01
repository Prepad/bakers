<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $fingerprint
 * @property string $token
 * @property Carbon $expired_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class RefreshToken extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'user_id',
        'fingerprint',
        'token',
        'expired_at',
        'created_at',
        'updated_at',
    ];



    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->expired_at > now();
    }
}
