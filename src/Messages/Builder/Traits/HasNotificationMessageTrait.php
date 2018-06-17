<?php

namespace ByTIC\Notifier\Messages\Builder\Traits;

use ByTIC\Notifier\Models\Messages\MessageTrait as Message;
use ByTIC\Notifier\Notifications\Notification;

/**
 * Trait HasNotificationMessageTrait
 * @package ByTIC\Notifications\Messages\Builder\Traits
 *
 * @method Notification getNotification
 */
trait HasNotificationMessageTrait
{
    protected $notificationMessage = null;

    /**
     * Returns the email subject
     *
     * @return string
     */
    public function generateEmailSubject()
    {
        return $this->getNotificationMessage()->getSubject();
    }

    /**
     * Returns the email content
     *
     * @return null|string
     */
    protected function generateEmailContent()
    {
        return $this->getNotificationMessage()->getContent();
    }

    /**
     * @return Message
     */
    protected function getNotificationMessage()
    {
        return $this->notificationMessage;
    }

    /**
     * @param Message $message
     */
    protected function setNotificationMessage($message)
    {
        $this->notificationMessage = $message;
    }
}
