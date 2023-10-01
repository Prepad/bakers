<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class AuthHelper
{
    /**
     * Генерация fingerprint
     *
     * @return string
     */
    public static function fingerprint(): string
    {
        return sha1(implode('|', [
            request()->userAgent(),
            request()->route()->getDomain()
        ]));
    }



    public static function token(): string
    {
        return Str::random();
    }
}
