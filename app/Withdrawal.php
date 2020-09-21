<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{

    protected $table = 'withdrawals';
    protected $fillable = ['id', 'date', 'athlete_id', 'team_id'];


}

