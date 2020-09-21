<?php

namespace Tests\Builders;

use App\Moves;

class MovesBuilder
{
    protected $attributes = [];

    public function create($Quantity = null)
    {
        return factory(Moves::class, $Quantity)->create($this->attributes);
    }

    public function make($Quantity = null)
    {
        return factory(Moves::class, $Quantity)->make($this->attributes);
    }

    public function setDescription($description): self
    {
        $this->attributes['description'] = $description;
        return $this;
    }

    public function setDate($date): self
    {
        $this->attributes['date'] = $date;
        return $this;
    }

    public function setValue($value): self
    {
        $this->attributes['value'] = $value;
        return $this;
    }

    public function setType($type): self
    {
        $this->attributes['type'] = $type;
        return $this;
    }

    public function setEspecification($specification): self
    {
        $this->attributes['specification'] = $specification;
        return $this;
    }
}
