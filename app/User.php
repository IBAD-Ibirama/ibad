<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use \Spatie\Permission\Traits\HasRoles;

    public function hobbies()
    {
        return $this->hasOne('App\Athlete');
    }

    public function moves()
    {
        return $this->hasMany('App\Moves');
    }

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
