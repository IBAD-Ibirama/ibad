<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    protected $fillable = [
      'birthdate', 'gender', 'rg', 'telephone', 'shift', 'grade', 'health_problem', 'medication', 'cloth_size', 'blood_type', 'imagem', 'school', 'user_id'
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function team()
    {
      return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function frequencies()
    {
        return $this->hasMany(Frequency::class, 'athlete_id', 'id');
    }
    
    public function evaluations()
    {
        return $this->hasMany(AthleteEvaluation::class);
    }
}
