<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Fillable fields.
     * 
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Return team's trainings.
     */
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
