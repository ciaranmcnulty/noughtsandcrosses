<?php

use NoughtsAndCrosses\Core\HandleBeginGame;
use NoughtsAndCrosses\Core\Infrastructure\Command;
use NoughtsAndCrosses\Core\HandleTakeMove;
use NoughtsAndCrosses\Bridge\InMemory\CommandBus;
use NoughtsAndCrosses\Bridge\InMemory\EventBus;
use NoughtsAndCrosses\Bridge\InMemory\Games;

class ScenarioTester
{
    private $eventBus;

    private $commandBus;

    public function __construct()
    {
        $this->eventBus = new EventBus();
        $this->commandBus = new CommandBus($this->eventBus, [
            new HandleBeginGame($this->eventBus),
            new HandleTakeMove($this->eventBus, new Games($this->eventBus))
        ]);
    }

    public function given(array $events)
    {
        $this->eventBus->addPriorEvents($events);
    }

    public function when(Command $command)
    {
        $this->commandBus->dispatch($command);
    }

    public function then(array $expectedEvents)
    {
        $actualEvents = $this->eventBus->getNewEvents();

        if ($actualEvents != $expectedEvents) {
            throw new \RuntimeException(sprintf(
                "Events did not match: \n%s\n%s",
                print_r($actualEvents, true),
                print_r($expectedEvents, true)
            ));
        }
    }

    public function thenNot($event)
    {
        if (in_array($event, $this->eventBus->getNewEvents())) {
            throw new \RuntimeException(sprintf(
                "Event was not expected: \n%s",
                $event
            ));
        }
    }
}
