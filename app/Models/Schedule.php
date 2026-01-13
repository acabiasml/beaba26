<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Schedule extends Model
{
    use Auditable;

    protected $guarded = [];

    public function classComponent()
    {
        return $this->belongsTo(ClassComponent::class);
    }
}
