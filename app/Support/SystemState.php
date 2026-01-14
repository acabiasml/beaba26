<?php

namespace App\Support;

use App\Models\User;

class SystemState
{
    public static function isFirstAccess(): bool
    {
        return User::count() === 0;
    }
}
