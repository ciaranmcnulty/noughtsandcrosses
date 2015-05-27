<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Command\Command;
use NoughtsAndCrosses\Core\Command\CommandHandler;
use NoughtsAndCrosses\Infrastructure\InMemory\EventBus;

class HandleBeginGame implements CommandHandler
{
    private $eventBus;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function handle(Command $command)
    {
        $game = Game::createNew();

        foreach ($game->getNewEvents() as $event) {
            $this->eventBus->dispatch($event);
        }
    }
}
