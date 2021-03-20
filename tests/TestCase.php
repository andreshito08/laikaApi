<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
                'api-key-laika' => 'p2lbgWkFrykA4QyUmp4s5ytcdfHihzmc5BNzIABqq23',
                'Accept' => 'application/json'
        ]);

    }

}
