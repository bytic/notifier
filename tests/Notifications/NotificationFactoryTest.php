<?php

namespace ByTIC\Notifier\Tests\Notifications;

use ByTIC\Notifier\Notifications\NotificationFactory;
use ByTIC\Notifier\Tests\AbstractTest;

/**
 * Class NotificationFactoryTest
 * @package ByTIC\Notifier\Tests\Notifications
 */
class NotificationFactoryTest extends AbstractTest
{

    /**
     * @param $class
     * @param $recipient
     * @param $target
     * @param $trigger
     * @dataProvider generateNotificationNameData
     */
    public function testGenerateNotificationName($class, $target, $trigger, $recipient)
    {
        self::assertSame($class, NotificationFactory::generateNotificationName($target, $trigger, $recipient));
    }

    /**
     * @return array
     */
    public function generateNotificationNameData()
    {
        return [
            [
                'App\Notifications\Fundraising_Pages\Pending\OrgSupportersNotification',
                'fundraising-page',
                'pending',
                'org_supporters'
            ],
        ];
    }
}
