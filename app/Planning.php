<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    /**
     * Fillable fields.
     * 
     * @var array
     */
    protected $fillable = [
        'training_id',
        'name',
        'description'
    ];

    /**
     * Returns planning's training.
     */
    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
