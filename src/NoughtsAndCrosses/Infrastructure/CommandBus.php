<?php

namespace NoughtsAndCrosses\Infrastructure;

class CommandBus
{
    private $eventBus;

    private $commandHandlers;

    public function __construct(EventBus $eventBus, array $commandHandlers)
    {
        $this->eventBus = $eventBus;
        $this->commandHandlers = $commandHandlers;
    }

    public function dispatch(Command $command)
    {
        foreach ($this->commandHandlers as $commandHandler)
        {
            $commandHandler->handle($command);
        }
    }
}
