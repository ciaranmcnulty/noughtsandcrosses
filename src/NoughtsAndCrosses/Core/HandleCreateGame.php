<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Infrastructure\Command;
use NoughtsAndCrosses\Infrastructure\CommandHandler;
use NoughtsAndCrosses\Infrastructure\EventBus;

class HandleCreateGame implements CommandHandler
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
