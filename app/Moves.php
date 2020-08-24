<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moves extends Model
{
    protected $fillable = [
        'descricao', 'data', 'valor', 'tipo', 'especificacao', 'id_usuario'
    ];
}
