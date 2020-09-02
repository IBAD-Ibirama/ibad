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

    public function setName($name): self
    {
        $this->attributes['name'] = $name;
        return $this;
    }

    public function setPassword($password): self
    {
        $this->attributes['password'] = $password;
        return $this;
    }
    public function setEmail($email): self
    {
        $this->attributes['email'] = $email;
        return $this;
    }
}
