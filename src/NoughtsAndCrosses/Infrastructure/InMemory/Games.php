<?php

namespace NoughtsAndCrosses\Infrastructure\InMemory;

use NoughtsAndCrosses\Core\Event\EventStore;
use NoughtsAndCrosses\Core\Game;
use NoughtsAndCrosses\Core\GameBegan;
use NoughtsAndCrosses\Core\GameId;
use NoughtsAndCrosses\Core\Games as GamesInterface;

class Games implements GamesInterface
{
    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function findById(GameId $id)
    {
        $events = $this->eventStore->findByAggregateId($id);

        return Game::fromEvents($events);
    }
}
