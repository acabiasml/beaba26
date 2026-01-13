<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Enrollment extends Model
{
    use Auditable;

    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
