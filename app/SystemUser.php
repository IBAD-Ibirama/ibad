<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemUser extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'permission'
    ];
}
