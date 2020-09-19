<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moves extends Model
{
    protected $fillable = [
        'description', 'date', 'value', 'type', 'specification', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
