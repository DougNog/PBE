<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isPorteiro(): bool { return $this->role === 'porteiro'; }
    public function isProfessor(): bool { return $this->role === 'professor'; }

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin'    => 'Administrador',
            'porteiro' => 'Porteiro',
            'professor' => 'Professor',
            default    => $this->role,
        };
    }
}
