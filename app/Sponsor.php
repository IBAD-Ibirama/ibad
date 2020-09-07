<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'cnpj',
        'name',
        'email'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
