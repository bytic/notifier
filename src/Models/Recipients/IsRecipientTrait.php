<?php

namespace ByTIC\Notifier\Models\Recipients;

use ByTIC\Notifications\Notifiable;

/**
 * Trait IsRecipientTrait
 * @package ByTIC\Notifier\Models\Recipients
 */
trait IsRecipientTrait
{

    /**
     * @return Notifiable[]
     */
    public function generateNotifiables()
    {
        return [$this];
    }
}
