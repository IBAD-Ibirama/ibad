<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AthleteEvaluationBodyIndex extends Model
{
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'athlete_evaluation_body_index';
    
    /**
     * Row's fields.
     * 
     * @var array
     */
    protected $fillable = [
        'athlete_evaluation_id',
        'body_index_id',
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
     * Get the body index that owns the row.
     */
    public function bodyIndex()
    {
        return $this->belongsTo(BodyIndex::class);
    }
}
