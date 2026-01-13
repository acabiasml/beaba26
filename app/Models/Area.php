<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
