<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Infrastructure\Command;
use NoughtsAndCrosses\Core\Infrastructure\CommandHandler;
use NoughtsAndCrosses\Bridge\InMemory\EventBus;

class HandleBeginGame implements CommandHandler
{
    private $eventBus;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function handle(Command $command)
    {
        $game = Game::begin($command->id());

        $this->eventBus->dispatchAll($game->getNewEvents());
    }

    public function supports(Command $command)
    {
        return $command instanceof BeginGame;
    }
}
