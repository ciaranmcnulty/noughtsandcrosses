<?php

namespace NoughtsAndCrosses\Infrastructure\InMemory;

use NoughtsAndCrosses\Core\Event\Event;

class EventBus implements \NoughtsAndCrosses\Core\Event\EventBus
{
    private $events = [];

    public function getEvents()
    {
        return $this->events;
    }

    public function dispatch(Event $event)
    {
        $this->events[] = $event;
    }
}
