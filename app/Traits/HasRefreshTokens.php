<?php

namespace App\Traits;

use App\Helpers\AuthHelper;
use App\Models\RefreshToken;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasRefreshTokens
{
    /**
     * @param string|null $fingerprint
     * @return HasOne
     */
    public function tokenModel(string $fingerprint = null): HasOne
    {
        if (!$fingerprint) {
            $fingerprint = AuthHelper::fingerprint();
        }

        return $this->hasOne(RefreshToken::class, 'user_id')
            ->where(['fingerprint' => $fingerprint]);
    }

    /**
     * Создает новый токен по user_id и fingerprint
     *
     * @param string|null $fingerprint
     * @param bool $remember Увеличенный срок жизни токена
     * @return string
     */
    public function createRefreshToken(string $fingerprint = null, bool $remember = false): string
    {
        if (!$fingerprint) {
            $fingerprint = AuthHelper::fingerprint();
        }

        return RefreshToken::updateOrCreate([
            'user_id' => $this->id,
            'fingerprint' => $fingerprint
        ], [
            'token' => AuthHelper::token(),
            // жизнь рефреш токена в секундах, поставил
            'expired_at' => now()->addSeconds(config('jwt.refresh_ttl'))
        ])->token;
    }

    /**
     * Удаляет токен пользователя для fingerprint
     *
     * @param string|null $fingerprint
     * @return void
     */
    public function invalidateRefreshToken(string $fingerprint = null)
    {
        $this->tokenModel($fingerprint)->delete();
    }

    /**
     * Возвращает текущий активный токен пользователя для fingerprint
     *
     * @param string|null $fingerprint
     * @return string|null
     */
    public function getCurrentRefreshToken(string $fingerprint = null): ?string
    {
        /** @var RefreshToken|null $tokenModel */
        $tokenModel = $this->tokenModel($fingerprint)->first();

        return $tokenModel?->isActive() ? $tokenModel->token : null;
    }

    /**
     * Проверяет, совпадает ли токен с содержимым базе для fingerprint
     *
     * @param string $token
     * @param string|null $fingerprint
     * @return bool
     */
    public function verifyRefreshToken(string $token, string $fingerprint = null): bool
    {
        return $this->getCurrentRefreshToken($fingerprint) === $token;
    }

    /**
     * @param Builder $b
     * @param string $token
     *
     * @return Builder
     */
    public function scopeWhereRefreshToken(Builder $b, string $token): Builder
    {
        return $b->whereHas('tokenModel', function ($query) use ($token) {
            return $query->where('token', $token)->where('expired_at', '>', now());
        });
    }
}
