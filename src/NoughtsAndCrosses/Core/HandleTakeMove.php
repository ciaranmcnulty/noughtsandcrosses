<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Infrastructure\Command;
use NoughtsAndCrosses\Core\Infrastructure\CommandHandler;
use NoughtsAndCrosses\Core\Infrastructure\EventBus;

class HandleTakeMove implements CommandHandler
{
    private $eventBus;

    private $games;

    public function __construct(EventBus $eventBus, Games $games)
    {
        $this->eventBus = $eventBus;
        $this->games = $games;
    }

    public function handle(Command $command)
    {
        $game = $this->games->findById($command->id());
        $game->play($command->square(), $command->player());

        $this->eventBus->dispatchAll($game->getNewEvents());
    }

    public function supports(Command $command)
    {
        return $command instanceof TakeMove;
    }
}
