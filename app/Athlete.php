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

$athletes = Athlete::all();
if (!count($athletes))
{
    foreach(factory(Athlete::class, 10)->make() as $athlete)
    {
        Athlete::create(['name' => $athlete->name]);
    }
}