<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Schedule;

class SchedulePolicy
{
    public function create(User $user, Schedule $schedule): bool
    {
        return ! $schedule
            ->classComponent
            ->class
            ->schoolYear
            ->is_closed;
    }

    public function update(User $user, Schedule $schedule): bool
    {
        return ! $schedule
            ->classComponent
            ->class
            ->schoolYear
            ->is_closed;
    }
}
