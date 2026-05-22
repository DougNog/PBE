<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Responsavel extends Model
{
    use Notifiable;

    protected $table = 'responsaveis';

    protected $fillable = ['nome', 'email', 'telefone'];

    public function alunos(): BelongsToMany
    {
        return $this->belongsToMany(Aluno::class, 'aluno_responsavel')
            ->withPivot('parentesco')
            ->withTimestamps();
    }

    public function routeNotificationForMail(): string
    {
        return $this->email;
    }
}
