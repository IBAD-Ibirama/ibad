<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hobbies()
    {
        return $this->hasOne('App\Athlete');
    }

    public function moves()
    {
        return $this->hasMany('App\Moves');
    }

    public function firstRoleName() {
        $roleName = null;
        if(count($roleNames = $this->getRoleNames()) > 0) {
            $roleName = $roleNames[0];
        }
        return $roleName;
    }
}
