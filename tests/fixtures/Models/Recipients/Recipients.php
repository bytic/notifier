<?php

namespace ByTIC\Notifier\Tests\Fixtures\Models\Recipients;

use ByTIC\Common\Records\Records;
use ByTIC\Notifier\Models\Recipients\RecipientsTrait;

/**
 * Class Recipient
 * @package ByTIC\Notifier\Tests\Fixtures\Models\Recipients
 */
class Recipients extends Records
{
    use RecipientsTrait;

    /**
     * @return string
     */
    public function getRootNamespace()
    {
        return '\ByTIC\Notifier\Tests\Fixtures\Models\\';
    }
}
