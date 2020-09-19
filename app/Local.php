<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locals';
    protected $fillable = ['description'];

    public function training()
    {
        return $this->hasMany(Training::class, 'local_id', 'id');
    }
}
