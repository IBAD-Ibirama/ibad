<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    /**
     * Fillable fields.
     * 
     * @var array
     */
    protected $fillable = [
        'date',
        'team_id'
    ];

    /**
     * Returns training's team.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    /**
     * Return training's plannings.
     */
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }
}
