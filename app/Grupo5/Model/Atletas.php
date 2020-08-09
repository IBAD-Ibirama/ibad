<?php

namespace App\Grupo5\Model;

use Illuminate\Database\Eloquent\Model;

class Atletas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'atletas';

    public function relFinanceiro() {
        return $this->hasMany('App\Grupo5\Model\Financeiro');
    }
}
