<?php

namespace ByTIC\Notifier\Tests\Notifications;

use ByTIC\Notifications\Notification;
use ByTIC\Notifier\Notifications\NotificationFactory;
use ByTIC\Notifier\Tests\AbstractTest;
use ByTIC\Notifier\Tests\Fixtures\Library\Application;

/**
 * Class NotificationFactoryTest
 * @package ByTIC\Notifier\Tests\Notifications
 */
class NotificationFactoryTest extends AbstractTest
{

    public function testCreateWithOneParam()
    {
        app()->set('app', new Application());

        $notification = NotificationFactory::create('fundraising-page', 'pending', 'org_supporters', ['789']);

        self::assertInstanceOf(Notification::class, $notification);
        self::assertSame($notification->param, '789');
    }

    /**
     * @param $class
     * @param $recipient
     * @param $target
     * @param $trigger
     * @dataProvider generateNotificationNameData
     */
    public function testGenerateNotificationName($class, $target, $trigger, $recipient)
    {
        app()->set('app', new Application());
        self::assertSame($class, NotificationFactory::generateNotificationName($target, $trigger, $recipient));
    }

    /**
     * @return array
     */
    public function generateNotificationNameData()
    {
        return [
            [
                'ByTIC\Notifier\Tests\Fixtures\Notifications\Fundraising_Pages\Pending\OrgSupportersNotification',
                'fundraising-page',
                'pending',
                'org_supporters'
            ],
        ];
    }
}
