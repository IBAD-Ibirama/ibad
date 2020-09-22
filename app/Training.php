<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'trainings';
    protected $fillable = ['date', 'time_init', 'time_end', 'week_day'];

    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id', 'id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');;
    }

    public function frequencies()
    {
        return $this->hasMany(Frequency::class, 'training_id', 'id');
    }

}

