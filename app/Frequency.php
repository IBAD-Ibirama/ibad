<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    protected $table = 'frequencies';
    protected $fillable = ['presence'];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id', 'id');
    }

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'id');
    }
}
