<?php

namespace ByTIC\Notifier\Messages\Builder;

use ByTIC\Notifications\Messages\Builder\EmailBuilder as GenericBuilder;
use ByTIC\Notifier\Messages\Builder\Traits\HasNotificationMessageTrait;
use ByTIC\Notifier\Notifications\Notification;

/**
 * Class AbstractBuilder
 *
 * @package ByTIC\Notifications\Messages\Builder
 *
 * @method Notification getNotification
 */
abstract class EmailBuilder extends GenericBuilder
{
    use HasNotificationMessageTrait;
}
