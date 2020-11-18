<?php

namespace ByTIC\Notifier\Models\Events;

use Nip\Utility\Traits\SingletonTrait;

/**
 * Trait EventsTrait
 * @package ByTIC\Notifier\Models\Events
 */
trait EventsTrait
{
    use \ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordsTrait;
    use SingletonTrait;

    /**
     * @inheritDoc
     */
    protected function injectParams(&$params = [])
    {
        $params['order'][] = ['id', 'ASC'];

        parent::injectParams($params);
    }

    /**
     * @return string
     */
    protected function generateTable()
    {
        return 'notification-events';
    }

    /**
     * @return string
     */
    public function getStatusItemsDirectory()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'Statuses';
    }

    /**
     * @return string
     */
    public function getStatusItemsRootNamespace()
    {
        return __NAMESPACE__ . '\Statuses\\';
    }
}
