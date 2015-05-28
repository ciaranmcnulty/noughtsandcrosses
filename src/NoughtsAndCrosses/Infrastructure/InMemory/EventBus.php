<?php

namespace NoughtsAndCrosses\Infrastructure\InMemory;

use NoughtsAndCrosses\Core\Event\Event;
use NoughtsAndCrosses\Core\Event\EventBus as EventBusInterface;
use NoughtsAndCrosses\Core\Event\EventStore;

class EventBus implements EventBusInterface, EventStore
{
    private $events = [];
    private $priorEvents = [];

    public function getEvents()
    {
        return $this->events;
    }

    public function dispatch(Event $event)
    {
        $this->events[] = $event;
    }

    public function dispatchAll(array $events)
    {
        foreach ($events as $event) {
            $this->events[] = $event;
        }
    }

    public function findByAggregateId($id)
    {
        return $this->events;
    }

    public function addPriorEvents(array $events)
    {
        $this->events = array_merge($this->events, $events);
        $this->priorEvents = array_merge($this->priorEvents, $events);
    }

    public function getNewEvents()
    {
        return array_values(array_udiff($this->events, $this->priorEvents, function ($a, $b) { return $a != $b; }));
    }
}
