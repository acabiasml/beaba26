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

    protected $attributes = [
        // padrão para novos anos do Ensino Médio
        'workload_rule' => 'medio_2400_600',
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

    /**
     * Helpers semânticos (opcional, mas recomendável)
     */
    public function uses1800_1200(): bool
    {
        return $this->workload_rule === 'medio_1800_1200';
    }

    public function uses2400_600(): bool
    {
        return $this->workload_rule === 'medio_2400_600';
    }
}
