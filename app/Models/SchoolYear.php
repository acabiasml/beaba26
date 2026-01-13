<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_closed' => 'boolean',
        'closed_at' => 'datetime',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function periods()
    {
        return $this->hasMany(Period::class);
    }

    public function classes()
    {
        return $this->hasMany(ClassRoom::class);
    }
}
