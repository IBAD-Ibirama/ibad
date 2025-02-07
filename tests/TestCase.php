<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Builders\MovesBuilder;
use Tests\Builders\SponsorBuilder;
use Tests\Builders\UserBuilder;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    public function sponsor(): SponsorBuilder
    {
        return new SponsorBuilder;
    }
    public function user()
    {
        return new UserBuilder;
    }
    public function moves()
    {
        return new MovesBuilder;
    }
}
