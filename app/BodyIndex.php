<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyIndex extends Model
{
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'body_indexes';
    
    /**
     * Body index's fields.
     * 
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
