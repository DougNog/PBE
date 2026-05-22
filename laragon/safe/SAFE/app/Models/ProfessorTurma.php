<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessorTurma extends Model
{
    public $timestamps = false;

    protected $table = 'professor_turma';

    protected $fillable = ['user_id', 'turma'];

    public function professor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
