<?php

namespace ByTIC\Notifier\Notifications;

use ByTIC\Notifier\Notifications\Traits\HasEventTrait;
use ByTIC\Notifier\Notifications\Traits\HasNotificationMessage;

/**
 * Class Notification
 * @package ByTIC\Notifier\Notifications
 */
class Notification extends \ByTIC\Notifications\Notification
{
    use HasEventTrait;
    use HasNotificationMessage;

    /**
     * @inheritdoc
     * @throws \ByTIC\Notifier\Exceptions\NotificationModelNotFoundException
     */
    public function generateMessageBuilder($type = 'mail')
    {
        $builder = parent::generateMessageBuilder($type);
        if ($this->hasEvent()) {
            $builder->setItem($this->getEvent()->getModel());
        }
        return $builder;
    }
}
