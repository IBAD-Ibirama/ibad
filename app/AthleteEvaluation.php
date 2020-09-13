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

    /**
     * Get evaluation's body indexes.
     */
    public function bodyIndexes()
    {
        return $this->hasMany(AthleteEvaluationBodyIndex::class);
    }

    /**
     * Get evaluation's physical test.
     * 
     * @param  \App\PhysicalTest $physicalTest
     * @return \App\AthleteEvaluationPhysicalTest
     */
    public function physicalTest(PhysicalTest $physicalTest): AthleteEvaluationPhysicalTest
    {
        $evaluationPhysicalTest = null;
        if($this->exists) {
            $evaluationPhysicalTest = $this->physicalTests()->where('physical_test_id', $physicalTest->id)->first();
        }
        return $evaluationPhysicalTest ?: new AthleteEvaluationPhysicalTest();
    }

    /**
     * Get evaluation's physical test.
     * 
     * @param  \App\BodyIndex $bodyIndex
     * @return \App\AthleteEvaluationPhysicalTest
     */
    public function bodyIndex(BodyIndex $bodyIndex): AthleteEvaluationBodyIndex
    {
        $evaluationBodyIndex = null;
        if($this->exists) {
            $evaluationBodyIndex = $this->bodyIndexes()->where('body_index_id', $bodyIndex->id)->first();
        }
        return $evaluationBodyIndex ?: new AthleteEvaluationBodyIndex();
    }
}
