<?php

namespace ByTIC\Notifier\Tests\Fixtures\Models\Messages;

use ByTIC\Common\Records\Records;
use ByTIC\Notifier\Models\Messages\MessagesTrait;

/**
 * Class Recipient
 * @package ByTIC\Notifier\Tests\Fixtures\Models\Messages
 */
class Messages extends Records
{
    use MessagesTrait;

    /**
     * @return string
     */
    public function getRootNamespace()
    {
        return '\ByTIC\Notifier\Tests\Fixtures\Models\\';
    }
}
