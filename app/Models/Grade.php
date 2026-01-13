<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Grade extends Model
{
    use Auditable;

    protected $guarded = [];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function component()
    {
        return $this->belongsTo(Component::class);
    }
}
