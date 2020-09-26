<?php

namespace Tests\Builders;

use App\Sponsor;

class SponsorBuilder
{
    protected $attributes = [];

    public function setCnpj($cnpj): self
    {
        $this->attributes['cnpj'] = $cnpj;

        return $this;
    }

    public function setEmail($email): self
    {
        $this->attributes['email'] = $email;

        return $this;
    }

    public function setValue($value): self
    {
        $this->attributes['value'] = $value;

        return $this;
    }


    public function create($Quantity = null)
    {
        return factory(Sponsor::class, $Quantity)->create($this->attributes);
    }

    public function make($Quantity = null)
    {
        return factory(Sponsor::class, $Quantity)->make($this->attributes);
    }
}
