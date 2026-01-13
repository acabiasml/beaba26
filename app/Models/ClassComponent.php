<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class ClassComponent extends Model
{
    use Auditable;

    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
