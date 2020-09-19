<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'competitions';
    protected $fillable = ['title', 'body'];

}
