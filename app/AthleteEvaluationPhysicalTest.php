<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AthleteEvaluationPhysicalTest extends Model
{

    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'athlete_evaluation_physical_test';
    
    /**
     * Row's fields.
     * 
     * @var array
     */
    protected $fillable = [
        'athlete_evaluation_id',
        'physical_test_id',
        'value'
    ];

    /**
     * Get the athlete evaluation that owns the row.
     */
    public function athleteEvaluation()
    {
        return $this->belongsTo(AthleteEvaluation::class);
    }

    /**
     * Get the physical test that owns the row.
     */
    public function physicalTest()
    {
        return $this->belongsTo(PhysicalTest::class);
    }

}
