<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $cnpj
 * @property string $string
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

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
