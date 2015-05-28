<?php

namespace NoughtsAndCrosses\Core\Event;

interface EventBus
{
    public function dispatch(Event $event);

    public function dispatchAll(array $events);
}