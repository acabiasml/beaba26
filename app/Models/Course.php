<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function classes()
    {
        return $this->hasMany(ClassRoom::class);
    }
}
