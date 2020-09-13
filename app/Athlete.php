<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    /**
     * Athlete's fields.
     * 
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get athlete's evaluations.
     */
    public function evaluations()
    {
        return $this->hasMany(AthleteEvaluation::class);
    }
}