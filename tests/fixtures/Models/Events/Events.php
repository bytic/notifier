<?php

namespace ByTIC\Notifier\Tests\Fixtures\Models\Events;

use ByTIC\Notifier\Models\Events\EventsTrait;

/**
 * Class Events
 * @package ByTIC\Notifier\Tests\Fixtures\Models\Events
 */
class Events extends \Nip\Records\RecordManager
{
    use EventsTrait;
}
