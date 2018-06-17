<?php

namespace ByTIC\Notifier\Notifications;

use ByTIC\Notifier\Messages\Builder\EmailBuilder;
use ByTIC\Notifier\Notifications\Traits\HasEventTrait;
use ByTIC\Notifier\Notifications\Traits\HasNotificationMessage;
use ByTIC\Notifier\Notifications\Traits\HasRecipientTrait;

/**
 * Class Notification
 * @package ByTIC\Notifier\Notifications
 */
class Notification extends \ByTIC\Notifications\Notification
{
    use HasEventTrait;
    use HasRecipientTrait;
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

        if ($this->hasNotificationMessage()) {
            $builder->setNotificationMessage($this->getNotificationMessage());
        }

        return $builder;
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @return string
     */
    public function generateMailBuilderClass()
    {
        return EmailBuilder::class;
    }
}
