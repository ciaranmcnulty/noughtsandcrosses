<?php

use NoughtsAndCrosses\Core\HandleBeginGame;
use NoughtsAndCrosses\Core\Command\Command;
use NoughtsAndCrosses\Core\HandlePlaySquareByPlayer;
use NoughtsAndCrosses\Infrastructure\InMemory\CommandBus;
use NoughtsAndCrosses\Infrastructure\InMemory\EventBus;
use NoughtsAndCrosses\Infrastructure\InMemory\Games;

class ScenarioTester
{
    private $eventBus;

    private $commandBus;

    private $priorEvents = array();

    public function __construct()
    {
        $this->eventBus = new EventBus();
        $this->commandBus = new CommandBus($this->eventBus, [
            new HandleBeginGame($this->eventBus),
            new HandlePlaySquareByPlayer($this->eventBus, new Games())
        ]);
    }

    public function given(array $events)
    {
        $this->priorEvents = $events;
    }

    public function when(Command $command)
    {
        $this->commandBus->dispatch($command);
    }

    public function then(array $expectedEvents)
    {
        $actualEvents = $this->eventBus->getEvents();

        if ($actualEvents != $expectedEvents) {
            throw new \RuntimeException(sprintf(
                "Events did not match: \n%s\n%s",
                var_export($actualEvents, true),
                var_export($expectedEvents, true)
            ));
        }
    }
} 