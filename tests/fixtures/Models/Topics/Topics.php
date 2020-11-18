<?php

namespace ByTIC\Notifier\Tests\Fixtures\Models\Topics;

use ByTIC\Notifier\Models\Topics\TopicsTrait;
use Nip\Records\RecordManager;

/**
 * Class Topics
 * @package ByTIC\Notifier\Tests\Fixtures\Models\Topics
 */
class Topics extends RecordManager
{
    use TopicsTrait;
}
