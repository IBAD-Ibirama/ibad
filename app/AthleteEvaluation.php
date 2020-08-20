<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AthleteEvaluation extends Model
{
    
    /**
     * Athlete evaluation's fields.
     * 
     * @var array
     */
    protected $fillable = [
        'athlete_id',
        'realization_date'
    ];

    /**
     * Get the athlete that owns the evaluation.
     */
    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    /**
     * Get evaluation's physical tests.
     */
    public function physicalTests()
    {
        return $this->hasMany(AthleteEvaluationPhysicalTest::class);
    }

}
