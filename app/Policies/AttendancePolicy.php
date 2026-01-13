<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Attendance;

class AttendancePolicy
{
    public function create(User $user, Attendance $attendance): bool
    {
        return ! $attendance->lesson
            ->classComponent
            ->class
            ->schoolYear
            ->is_closed;
    }

    public function update(User $user, Attendance $attendance): bool
    {
        return ! $attendance->lesson
            ->classComponent
            ->class
            ->schoolYear
            ->is_closed;
    }
}
