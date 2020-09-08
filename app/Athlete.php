<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    protected $fillable = [
        'dataNasc', 'sexo', 'rg', 'fone', 'periodo', 'serie', 'problemaSaude', 'medicacao', 'tamanhoUniforme', 'tipoSangue', 'imagem', 'escola', 'user_id'
    ];
}
