<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingHelper extends Model
{
    protected $table = 'trainings_helpers';
    protected $fillable = ['helper_id','training_id'];

    
}

