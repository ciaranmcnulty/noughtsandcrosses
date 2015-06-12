<?php

namespace NoughtsAndCrosses\Core\Infrastructure;

interface EventListener
{
    public function handle(Event $event);
} 