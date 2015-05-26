<?php

use NoughtsAndCrosses\Core\HandleCreateGame;
use NoughtsAndCrosses\Infrastructure\Command;
use NoughtsAndCrosses\Infrastructure\CommandBus;
use NoughtsAndCrosses\Infrastructure\EventBus;

class ScenarioTester
{
    private $eventBus;

    private $commandBus;

    public function __construct()
    {
        $this->eventBus = new EventBus();
        $this->commandBus = new CommandBus($this->eventBus, [
            new HandleCreateGame($this->eventBus)
        ]);
    }

    public function when(Command $command)
    {
        $this->commandBus->dispatch($command);
    }

    public function then(array $events)
    {
        if ($this->eventBus->getEvents() != $events) {
            throw new \RuntimeException('Events did not match');
        }
    }
} 