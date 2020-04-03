<?php

namespace ByTIC\Notifier\Controllers;

use ByTIC\Notifier\Models\Messages\MessageTrait;
use ByTIC\Notifier\Notifications\NotificationFactory;

/**
 * Trait MessagesControllerTrait
 * @package ByTIC\Notifier\Controllers
 *
 * @method MessageTrait getModelFromRequest
 */
trait MessagesControllerTrait
{

    public function view()
    {
        parent::view();

        $item = $this->getModelFromRequest();
        $recipient = $item->getNotificationRecipient();

        $notification = NotificationFactory::createFromRecipient($recipient);
        $notification->setNotificationMessage($item);
        $this->getView()->set('nMergeFields', $notification->generateMessageBuilder()->getMergeFields());
    }
}
