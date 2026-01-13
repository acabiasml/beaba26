<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Grade;

class GradePolicy
{
    public function create(User $user, Grade $grade): bool
    {
        if ($user->role !== 'professor') {
            return false;
        }

        return $grade->classComponent
            ->teachers()
            ->where('users.id', $user->id)
            ->exists();
    }


    public function update(User $user, Grade $grade): bool
    {
        return ! $grade->period
            ->schoolYear
            ->is_closed;
    }

    public function delete(User $user, Grade $grade): bool
    {
        return ! $grade->period
            ->schoolYear
            ->is_closed;
    }
}
