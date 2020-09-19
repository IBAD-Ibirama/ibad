<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaultLimit extends Model
{
    protected $table = 'fault_limits';
    protected $fillable = ['limit'];
}
