<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Athletes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'athletes';

    public function relFinances() {
        return $this->hasMany('App\Model\Finances');
    }
}
