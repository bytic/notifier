<?php

namespace ByTIC\Notifier\Models\Events;

use ByTIC\Notifications\ChannelManager;
use ByTIC\Notifier\Models\Recipients\RecipientTrait;
use ByTIC\Notifier\Notifications\NotificationFactory;

/**
 * Class EventDispatcher
 * @package ByTIC\Notifier\Models\Events
 */
class EventDispatcher
{
    /**
     * @var EventTrait
     */
    protected $event;

    protected $recipients = null;

    /**
     * EventDispatcher constructor.
     * @param EventTrait $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * @param $event
     * @return EventDispatcher
     */
    public static function create($event)
    {
        $dispatcher = new static($event);
        return $dispatcher;
    }

    /**
     * @throws \ByTIC\Notifier\Exceptions\NotificationModelNotFoundException
     * @throws \ByTIC\Notifier\Exceptions\NotificationRecipientModelNotFoundException
     */
    public function dispatch()
    {
        $recipients = $this->getRecipients();
        foreach ($recipients as $recipient) {
            $this->dispatchForRecipient($recipient);
        }
    }

    /**
     * @param RecipientTrait $recipient
     * @throws \ByTIC\Notifier\Exceptions\NotificationModelNotFoundException
     * @throws \ByTIC\Notifier\Exceptions\NotificationRecipientModelNotFoundException
     */
    public function dispatchForRecipient($recipient)
    {
        if ($recipient->isActive()) {
            $notification = NotificationFactory::createFromRecipient($recipient);

            if (method_exists($notification, 'setEvent')) {
                $notification->setEvent($this->getEvent());
            }

            $notifiables = $recipient->generateNotifiablesForEvent($this->getEvent());
            $this->sendNotification($notifiables, $notification);
        }
    }

    /**
     * @param $notifiables
     * @param $notification
     */
    protected function sendNotification($notifiables, $notification)
    {
        ChannelManager::instance()->send($notifiables, $notification);
    }

    /**
     * @return EventTrait
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return RecipientTrait[]
     */
    public function getRecipients()
    {
        if ($this->recipients === null) {
            $this->initRecipients();
        }
        return $this->recipients;
    }

    protected function initRecipients()
    {
        $this->setRecipients($this->getEvent()->getRecipients());
    }

    /**
     * @param mixed $recipients
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
    }
}
