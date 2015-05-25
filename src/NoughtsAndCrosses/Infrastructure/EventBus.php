<?php

namespace NoughtsAndCrosses\Infrastructure;

class EventBus
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
