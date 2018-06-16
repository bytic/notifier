<?php

namespace ByTIC\Notifier\Tests\Fixtures\Models\Recipients;

use ByTIC\Common\Records\Record;
use ByTIC\Notifier\Models\Recipients\RecipientTrait;

/**
 * Class Recipient
 * @package ByTIC\Notifier\Tests\Fixtures\Models\Recipients
 */
class Recipient extends Record
{
    use RecipientTrait;
}
