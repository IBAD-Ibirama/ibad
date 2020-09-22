<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
    use SoftDeletes;

    protected $table = 'withdrawals';
    protected $fillable = ['id', 'date'];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class, 'athlete_id', 'id');
    }

    public function team()
    {
      return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}

