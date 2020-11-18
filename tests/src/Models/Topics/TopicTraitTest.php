<?php

namespace ByTIC\Notifier\Tests\Models\Topics;

use ByTIC\Notifier\Tests\AbstractTest;
use ByTIC\Notifier\Tests\Fixtures\Models\Events\Event;
use ByTIC\Notifier\Tests\Fixtures\Models\Events\Events;
use ByTIC\Notifier\Tests\Fixtures\Models\Topics\Topic;
use Nip\Records\Locator\ModelLocator;
use Nip\Records\Record;

/**
 * Class TopicTraitTest
 * @package ByTIC\Notifier\Tests\Models\Topics
 */
class TopicTraitTest extends AbstractTest
{
    public function test_fireEvent()
    {
        $eventMock = \Mockery::mock(Event::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $eventsMock = \Mockery::mock(Events::class)->shouldAllowMockingProtectedMethods()->makePartial();

        $eventMock->shouldReceive('getManager')->andReturn($eventsMock);
        $eventMock->shouldReceive('save')->once();
        $eventsMock->shouldReceive('getNew')->andReturn($eventMock);

        ModelLocator::set('Notifications\Events', $eventsMock);

        $model = new Record();

        $topic = new Topic();
        $event = $topic->fireEvent($model);

        self::assertSame('pending', $event->getAttribute('status'));
    }
}