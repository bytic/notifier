<?php

namespace ByTIC\Notifier\Tests\Legacy\Notifications;

use ByTIC\Notifications\ChannelManager;
use ByTIC\Notifications\Channels\EmailDbChannel;
use ByTIC\Notifier\Tests\AbstractTest;

/**
 * Class ChannelManagerTest
 * @package ByTIC\Notifications\Tests
 */
class ChannelManagerTest extends AbstractTest
{
    public function testDriverMailDb()
    {
        $manager = new ChannelManager();
        
        $channel = $manager->channel('emailDb');
        $this->assertInstanceOf(EmailDbChannel::class, $channel);
    }
}
