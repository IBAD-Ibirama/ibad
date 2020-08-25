<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $cnpj
 * @property double $value
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Sponsor extends Model
{
    protected $fillable = [
        'cnpj',
        'value',
        'email'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
