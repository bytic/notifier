<?php

namespace ByTIC\Notifier\Tests;

use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends TestCase
{
    protected $object;

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
