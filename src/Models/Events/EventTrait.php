<?php

namespace ByTIC\Notifier\Models\Events;

use ByTIC\Common\Records\Emails\Builder\BuilderAwareTrait;
use ByTIC\Notifier\Exceptions\NotificationModelNotFoundException;
use ByTIC\Notifier\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\Notifier\Models\Recipients\RecipientTrait;
use ByTIC\Notifier\Models\Topics\TopicTrait as Topic;
use Nip\Records\AbstractModels\Record;

/**
 * Trait EventsTrait
 * @package ByTIC\Notifier\Models\Events
 *
 * @method Topic getTopic()
 *
 * @property int $id_topic
 * @property int $id_item
 */
trait EventTrait
{
    use \ByTIC\Common\Records\Traits\HasStatus\RecordTrait;

    /**
     * @var null|Record
     */
    protected $model = null;

    /**
     * @return bool
     */
    public function send()
    {
        try {
            $this->sendToDispatcher();
        } catch (NotificationRecipientModelNotFoundException $exception) {
            $this->updateStatus('skipped');

            return;
        } catch (NotificationModelNotFoundException $exception) {
            $this->updateStatus('skipped');

            return;
        }
        $this->updateStatus('sent');

        return true;
    }

    /**
     * @throws NotificationModelNotFoundException
     * @throws NotificationRecipientModelNotFoundException
     */
    protected function sendToDispatcher()
    {
        EventDispatcher::create($this)->dispatch();
    }

    /**
     * @return RecipientTrait[]
     */
    public function getRecipients()
    {
        return $this->getTopic()->getRecipients();
    }

    /**
     * @param Topic $topic
     */
    public function populateFromTopic($topic)
    {
        $this->id_topic = $topic->id;
    }

    /**
     * @param Record $model
     */
    public function populateFromModel($model)
    {
        $this->setModel($model);
        $this->id_item = $model->id;
    }

    /**
     * @return Record|BuilderAwareTrait
     * @throws NotificationModelNotFoundException
     */
    public function getModel()
    {
        if ($this->model === null) {
            $this->initModel();
        }

        return $this->model;
    }

    /**
     * @throws NotificationModelNotFoundException
     */
    public function initModel()
    {
        $item = $this->findModel();
        if ($item instanceof Record) {
            $this->setModel($item);

            return;
        }
        throw new NotificationModelNotFoundException('Error finding item [' . $this->id_item . ']');
    }

    /**
     * @param Record|null $model
     */
    public function setModel(Record $model)
    {
        $this->model = $model;
    }

    /**
     * @return Record
     */
    public function findModel()
    {
        $manager = $this->getTopic()->getTargetManager();

        return $manager->findOne($this->id_item);
    }
}
