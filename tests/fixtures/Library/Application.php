<?php

namespace ByTIC\Notifier\Tests\Fixtures\Library;

/**
 * Class Application
 * @package ByTIC\Notifier\Tests\Fixtures\Library
 */
class Application extends \ByTIC\Common\Library\Application
{

    /**
     * @inheritdoc
     */
    public function getRootNamespace()
    {
        return 'ByTIC\Notifier\Tests\Fixtures';
    }
}
