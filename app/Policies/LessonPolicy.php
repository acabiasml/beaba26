<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lesson;

class LessonPolicy
{
    public function create(User $user, Lesson $lesson): bool
    {
        return ! $lesson
            ->classComponent
            ->class
            ->schoolYear
            ->is_closed;
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return ! $lesson
            ->classComponent
            ->class
            ->schoolYear
            ->is_closed;
    }
}
