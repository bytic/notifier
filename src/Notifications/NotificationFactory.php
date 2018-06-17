<?php

namespace ByTIC\Notifier\Notifications;

use Nip\Container\Container;

/**
 * Class NotificationFactory
 * @package ByTIC\Notifier\Notifications
 */
class NotificationFactory
{
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
