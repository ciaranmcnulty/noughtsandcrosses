<?php

use NoughtsAndCrosses\Core\HandleBeginGame;
use NoughtsAndCrosses\Core\Command\Command;
use NoughtsAndCrosses\Infrastructure\InMemory\CommandBus;
use NoughtsAndCrosses\Infrastructure\InMemory\EventBus;

class ScenarioTester
{
    private $eventBus;

    private $commandBus;

    public function __construct()
    {
        $this->eventBus = new EventBus();
        $this->commandBus = new CommandBus($this->eventBus, [
            new HandleBeginGame($this->eventBus)
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