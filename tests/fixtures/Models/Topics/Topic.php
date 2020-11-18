<?php

namespace ByTIC\Notifier\Tests\Fixtures\Models\Topics;

use ByTIC\Notifier\Models\Topics\TopicTrait;
use Nip\Records\Record as NipRecord;

/**
 * Class Topic
 * @package ByTIC\Notifier\Tests\Fixtures\Models\Topics
 */
class Topic extends NipRecord
{
    use TopicTrait;
}
