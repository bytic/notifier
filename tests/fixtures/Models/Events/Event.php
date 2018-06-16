<?php

namespace ByTIC\Notifier\Tests\Fixtures\Models\Events;

use ByTIC\Common\Records\Record;
use ByTIC\Notifier\Models\Events\EventTrait;

/**
 * Class Events
 * @package ByTIC\Notifier\Tests\Fixtures\Models\Events
 */
class Event extends Record
{
    use EventTrait;
}
