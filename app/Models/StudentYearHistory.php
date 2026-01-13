<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentYearHistory extends Model
{
    protected $guarded = [];

    public function components()
    {
        return $this->hasMany(StudentYearComponent::class);
    }
}
