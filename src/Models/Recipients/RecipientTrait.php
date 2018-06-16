<?php

namespace ByTIC\Notifier\Models\Recipients;

use ByTIC\Common\Records\Traits\HasTypes\RecordTrait;
use ByTIC\Notifier\Exceptions\NotificationModelNotFoundException;
use ByTIC\Notifier\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\Notifier\Models\Events\EventTrait as Event;
use ByTIC\Notifier\Models\Recipients\Types\AbstractType;
use ByTIC\Notifier\Models\Topics\TopicTrait as Topic;
use ByTIC\Notifier\Models\Messages\MessageTrait as Message;
use ByTIC\Notifier\Notification;
use ByTIC\Notifier\Models\Messages\MessagesTrait as Messages;
use Nip\Records\Record;
use Nip\Records\RecordManager as Records;

/**
 * Class RecipientTrait
 * @package ByTIC\Notifier\Models\Recipients
 *
 * @property int $id_topic
 * @property string $recipient
 * @property string $type
 * @property string $active
 *
 * @method AbstractType getType
 * @method Topic getTopic
 * @method RecipientsTrait getManager()
 */
trait RecipientTrait
{
    use RecordTrait;

    protected $recipientManager = null;

    /**
     * @param Event $event
     * @return bool
     * @throws NotificationModelNotFoundException
     * @throws NotificationRecipientModelNotFoundException
     */
    public function sendEvent($event)
    {
        if ($this->isActive()) {
            return $this->getType()->sendEvent($event);
        }
        return true;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active == 'yes';
    }

    /**
     * @param Event|null $event
     * @return Notification
     */
    public function generateNotification($event = null)
    {
        $class = $this->generateNotificationName();
        /** @var Notification $notification */
        $notification = new $class($event);
        return $notification;
    }

    /**
     * @return string
     */
    public function generateNotificationName()
    {
        return $this->getManager()::generateNotificationName(
            $this->getRecipient(),
            $this->getTopic()->getTarget(),
            $this->getTopic()->getTrigger()
        );
    }

    /**
     * @param Notification $notification
     * @return RecipientTrait
     * @throws NotificationModelNotFoundException
     */
    public function getModelFromNotification($notification)
    {
        $method = $this->generateRecipientGetterMethod();
        $model = $notification->getEvent()->getModel();
        if ($model instanceof Record) {
            return $model->$method();
        }
        return null;
    }

    /**
     * Return the Message from the database with the text to include
     * in the notification
     *
     * @param string $channel
     * @return Message
     */
    public function getNotificationMessage($channel = 'email')
    {
        return Messages::getGlobal(
            $this->id_topic,
            $this->getRecipient(),
            $channel
        );
    }

    /**
     * @return Records
     */
    public function getRecipientManager()
    {
        if ($this->recipientManager === null) {
            $this->recipientManager = $this->generateRecipientManager();
        }
        return $this->recipientManager;
    }

    /**
     * @return Records
     */
    public function generateRecipientManager()
    {
        return $this->getManager()::getRecipientManager($this->getRecipient());
    }

    /**
     * @return string
     */
    public function generateRecipientGetterMethod()
    {
        return $this->getManager()::generateRecipientGetterMethod($this->getRecipient());
    }
}
