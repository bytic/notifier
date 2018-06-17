<?php

namespace ByTIC\Notifier\Notifications\Traits;

use ByTIC\Notifier\Models\Messages\MessageTrait as Message;
use ByTIC\Notifier\Models\Messages\MessagesTrait as Messages;
use Nip\Records\Locator\ModelLocator;

/**
 * Trait HasNotificationMessage
 * @package ByTIC\Notifier\Notifications\Traits
 */
trait HasNotificationMessage
{

    /**
     * Notification Message
     *
     * @var Message
     */
    protected $notificationMessage = null;

    /**
     * Instances and returns the Notification Message Record
     *
     * @return Message
     */
    public function getNotificationMessage()
    {
        if ($this->notificationMessage == null) {
            $this->initNotificationMessage();
        }
        return $this->notificationMessage;
    }

    /**
     * @return bool
     */
    public function hasNotificationMessage()
    {
        return is_object($this->getNotificationMessage());
    }

    /**
     * Instances the Notigication Record
     *
     * @return void
     */
    protected function initNotificationMessage()
    {
        $this->notificationMessage = $this->generateNotificationMessage();
    }

    /**
     * Return the Message from the database with the text to include
     * in the notification
     *
     * @return Message
     */
    protected function generateNotificationMessage()
    {
        /** @var Messages $messages */
        $messages = ModelLocator::get('Notifications\Messages');
        return $messages::getGlobal(
            $this->getEvent()->getTopic(),
            $this->getRecipientName(),
            'email'
        );
    }

//    /**
//     * @param EmailBuilder $message
//     * @return mixed
//     */
//    protected function populateEmailMessage($message)
//    {
//        $message->setNotification($this);
//        $model = $this->getEvent() ? $this->getEvent()->getModel() : null;
//        if ($model) {
//            $message->setItem($model);
//        }
//        return $message;
//    }
}
