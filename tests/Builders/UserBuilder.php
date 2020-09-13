<?php

namespace Tests\Builders;

use App\User;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class UserBuilder
{
    protected $attributes = [];

    public function create($Quantity = null)
    {
        return factory(User::class, $Quantity)->create($this->attributes);
    }

    public function make($Quantity = null)
    {
        return factory(User::class, $Quantity)->make($this->attributes);
    }
}
