<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atributos atribuíveis em massa
     */
    protected $fillable = [
        'person_id',
        'name',
        'email',
        'password',
        'role',
        'archived',
        'auth_provider',
        'provider_id',
    ];


    /**
     * Atributos ocultos na serialização
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'archived' => 'boolean',
        ];
    }

    /**
     * Relação com dados civis
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Helpers de papel (opcional, mas útil)
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGestor(): bool
    {
        return $this->role === 'gestor';
    }

    public function isProfessor(): bool
    {
        return $this->role === 'professor';
    }

    public function isAluno(): bool
    {
        return $this->role === 'aluno';
    }
}
