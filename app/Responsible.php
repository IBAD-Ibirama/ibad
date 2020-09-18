<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    public function athletes(){
        return $this->belongsToMany('App\Athlete');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'cpf', 'phone', 'user_id'
    ];
}
