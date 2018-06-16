<?php

namespace ByTIC\Notifier\Tests\Models\Events;

use ByTIC\Notifier\Models\Events\Statuses\Pending;
use ByTIC\Notifier\Models\Events\Statuses\Sent;
use ByTIC\Notifier\Models\Events\Statuses\Skipped;
use ByTIC\Notifier\Tests\AbstractTest;
use ByTIC\Notifier\Tests\Fixtures\Models\Events\Events;

/**
 * Class EventsTraitTest
 * @package ByTIC\Notifier\Tests\Models\Events
 */
class EventsTraitTest extends AbstractTest
{
    public function testGetStatuses()
    {
        $statuses = Events::instance()->getStatuses();

        self::assertCount(3, $statuses);
        self::assertInstanceOf(Pending::class, $statuses['pending']);
        self::assertInstanceOf(Sent::class, $statuses['sent']);
        self::assertInstanceOf(Skipped::class, $statuses['skipped']);
    }
}
