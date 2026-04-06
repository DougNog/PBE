<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $fillable = [
        'nome',
        'unidade_medida',
        'preco_unitario',
        'estoque',
    ];
}