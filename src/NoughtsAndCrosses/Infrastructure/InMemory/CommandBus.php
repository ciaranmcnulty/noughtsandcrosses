<?php

namespace NoughtsAndCrosses\Infrastructure\InMemory;

use NoughtsAndCrosses\Core\Command\Command;
use NoughtsAndCrosses\Core\Command\CommandBus as CommandBusInterface;

class CommandBus implements CommandBusInterface
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
        foreach ($this->commandHandlers as $commandHandler) {
            if ($commandHandler->supports($command)) {
                $commandHandler->handle($command);
            }
        }
    }
}
