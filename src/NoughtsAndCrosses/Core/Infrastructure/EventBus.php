<?php

namespace NoughtsAndCrosses\Core\Infrastructure;

interface EventBus
{
    public function dispatch(Event $event);

    public function dispatchAll(array $events);
}