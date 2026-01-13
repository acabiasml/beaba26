<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SchoolYear;

class SchoolYearPolicy
{
    public function modify(User $user, SchoolYear $schoolYear): bool
    {
        // Admin pode tudo
        if ($user->role === 'admin') {
            return true;
        }

        // Ano fechado: ninguém mexe
        return ! $schoolYear->is_closed;
    }
}
