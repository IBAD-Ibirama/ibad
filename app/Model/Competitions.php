<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Competitions extends Model
{
    protected $fillable = ['title','body'];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'competitions';
}
