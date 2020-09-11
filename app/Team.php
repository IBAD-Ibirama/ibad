<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $table = 'teams';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name'];

    public function teamLevel()
    {
        return $this->belongsTo(TeamLevel::class, 'team_level_id', 'id');
    }
}
