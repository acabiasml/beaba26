<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Enrollment;

class EnrollmentPolicy
{
    public function update(User $user, Enrollment $enrollment): bool
    {
        return ! $enrollment
            ->class
            ->schoolYear
            ->is_closed;
    }
}
