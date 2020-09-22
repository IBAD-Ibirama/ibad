<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamLevel extends Model
{
    protected $table = 'team_levels';
    protected $fillable = ['name', 'requires_auxiliary', 'can_be_auxiliary'];

    public function teams()
    {
        return $this->hasMany(Team::class, 'team_level_id', 'id');
    }
}
