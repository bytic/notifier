<?php

namespace ByTIC\Notifier\Models\Recipients\Types;

use \ByTIC\Models\SmartProperties\Properties\Types\Generic;
use ByTIC\Notifier\Exceptions\NotificationModelNotFoundException;
use ByTIC\Notifier\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\Notifier\ChannelManager;
use ByTIC\Notifier\Models\Events\EventTrait as Event;
use ByTIC\Notifier\Models\Recipients\RecipientTrait as Recipient;
use Nip\Records\AbstractModels\Record;

/**
 * Class AbstractType
 * @package ByTIC\Notifier\Models\Recipients\Types
 *
 * @method Recipient getItem
 */
abstract class AbstractType extends Generic
{
    /**
     * @param Event $event
     * @return int
     * @throws NotificationRecipientModelNotFoundException
     * @throws NotificationModelNotFoundException
     */
    public function sendEvent($event)
    {
        $notification = $this->getItem()->generateNotification($event);
        $recipientModel = $this->getItem()->getRecipientModelFromEvent($notification);
        if ($recipientModel) {
            $notifiables = $this->generateNotifiables($recipientModel);

            return $this->sendNotification($notifiables, $notification);
        }
    }
}
