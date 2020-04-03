<?php

namespace ByTIC\Notifier\Tests\Fixtures\Models\Messages;

use ByTIC\Common\Records\Record;
use ByTIC\Notifier\Models\Messages\MessageTrait;

/**
 * Class Message
 * @package ByTIC\Notifier\Tests\Fixtures\Models\Messages
 */
class Message extends Record
{
    use MessageTrait;
}
