<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function responsibles(){
        return $this->belongsToMany('App\Responsible');
    }

    protected $fillable = [
        'birthdate', 'gender', 'rg', 'telephone', 'shift', 'grade', 'health_problem', 'medication', 'cloth_size', 'blood_type', 'imagem', 'school', 'user_id'
    ];
}
