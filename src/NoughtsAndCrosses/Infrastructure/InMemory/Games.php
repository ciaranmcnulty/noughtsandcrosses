<?php

namespace NoughtsAndCrosses\Infrastructure\InMemory;

use NoughtsAndCrosses\Core\Game;
use NoughtsAndCrosses\Core\GameHasBegun;
use NoughtsAndCrosses\Core\GameIdentity;
use NoughtsAndCrosses\Core\Games as GamesInterface;

class Games implements GamesInterface
{
    public function findById(GameIdentity $id)
    {
        return Game::fromEvents([
            new GameHasBegun($id)
        ]);
    }
}
