<?php

namespace ByTIC\Notifier\Notifications;

use ByTIC\Notifications\Notification;
use ByTIC\Notifier\Models\Recipients\RecipientTrait;
use Nip\Container\Container;

/**
 * Class NotificationFactory
 * @package ByTIC\Notifier\Notifications
 */
class NotificationFactory
{
    /**
     * @param RecipientTrait $recipient
     * @param array $params
     * @return mixed
     */
    public static function createFromRecipient($recipient, $params = [])
    {
        $notification = static::create(
            $recipient->getTopic()->getTarget(),
            $recipient->getTopic()->getTrigger(),
            $recipient->getRecipient(),
            $params
        );
        if (method_exists($notification, 'setRecipient')) {
            $notification->setRecipient($recipient);
        }
        return $notification;
    }

    /**
     * @param $target
     * @param $trigger
     * @param $recipient
     * @param array $params
     * @return Notification
     */
    public static function create($target, $trigger, $recipient, $params = [])
    {
        $class = static::generateNotificationName($target, $trigger, $recipient);
        $notification = new $class(...$params);
        return $notification;
    }

    /**
     * @param $recipient
     * @param $target
     * @param $trigger
     * @return string
     */
    public static function generateNotificationName($target, $trigger, $recipient)
    {
        $name = trim(self::getRootNamespace(), '\\');
        $name .= '\Notifications\\';
        $name .= inflector()->pluralize(inflector()->classify($target)) . '\\';
        $name .= ucfirst($trigger) . '\\';
        $name .= inflector()->pluralize(inflector()->classify($recipient));
        $name .= 'Notification';
        return $name;
    }

    /**
     * @return string
     */
    public static function getRootNamespace()
    {
        if (function_exists('app') && app() instanceof Container && app()->has('app')) {
            return app('app')->getRootNamespace();
        }
        return 'App\\';
    }
}
