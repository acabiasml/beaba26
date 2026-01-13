<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Attendance extends Model
{
    use Auditable;

    protected $guarded = [];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
