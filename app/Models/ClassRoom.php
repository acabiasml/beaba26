<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $table = 'classes';
    protected $guarded = [];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function components()
    {
        return $this->hasMany(ClassComponent::class);
    }
}
