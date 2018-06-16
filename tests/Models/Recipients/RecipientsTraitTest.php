<?php

namespace ByTIC\Notifier\Tests\Models\Recipients;

use ByTIC\Notifier\Models\Recipients\Types\Collection;
use ByTIC\Notifier\Models\Recipients\Types\Single;
use ByTIC\Notifier\Tests\AbstractTest;
use ByTIC\Notifier\Tests\Fixtures\Models\Recipients\Recipients;

/**
 * Class RecipientsTraitTest
 * @package ByTIC\Notifier\Tests\Models\Recipients
 */
class RecipientsTraitTest extends AbstractTest
{
    public function testGetTypes()
    {
        $types = Recipients::instance()->getTypes();

        self::assertCount(2, $types);
        self::assertInstanceOf(Collection::class, $types['collection']);
        self::assertInstanceOf(Single::class, $types['single']);
    }

    /**
     * @param $notification
     * @param $recipient
     * @param $target
     * @param $trigger
     *
     * @dataProvider generateNotificationNameData
     */
    public function testGenerateNotificationName($notification, $recipient, $target, $trigger)
    {
        self::assertSame($notification, Recipients::generateNotificationName($recipient, $target, $trigger));
    }

    /**
     * @return array
     */
    public function generateNotificationNameData()
    {
        $base = '\ByTIC\Notifier\Tests\Fixtures\Models\\';
        return [
            [
                $base . 'OrgSupporters\Notifications\Fundraising_Pages\PendingNotification',
                'org_supporters',
                'fundraising-page',
                'pending'
            ],
            [
                $base . 'OrgSupporters\Notifications\FundraisingPages\PendingNotification',
                'org_supporters',
                'fundraising_page',
                'pending'
            ],
        ];
    }
}
