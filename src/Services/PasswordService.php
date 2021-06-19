<?php

namespace App\Services;

class PasswordService
{
    public static function decrypt($password): bool|string
    {
        return base64_decode($password);
    }

    public static function encrypt($password): string
    {
        return base64_encode($password);
    }
}