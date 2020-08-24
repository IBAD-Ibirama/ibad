<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Competitions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'competitions';
    
    protected $dateFormat = 'd/m/y H:m:s';
   
    protected $dates = [
        'date',
    ];
}
