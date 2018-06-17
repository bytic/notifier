<?php

namespace ByTIC\Notifier\Notifications\Traits;

use ByTIC\Notifier\Models\Recipients\RecipientTrait as Recipient;

/**
 * Trait HasEventTrait
 * @package ByTIC\Notifier\Notifications\Traits
 */
trait HasRecipientTrait
{
    /**
     * @var Recipient
     */
    protected $recipient = null;

    /**
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param Recipient $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return bool
     */
    public function hasRecipient()
    {
        return is_object($this->recipient)
            && in_array('ByTIC\Notifier\Models\Recipients\RecipientTrait', class_uses($this->recipient));
    }

    /**
     * @inheritdoc
     */
    public function getRecipientName()
    {
        return $this->getRecipient()->getRecipient();
    }
}
