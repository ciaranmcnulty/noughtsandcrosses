<?php

namespace spec\NoughtsAndCrosses\Infrastructure\InMemory;

use NoughtsAndCrosses\Core\Game;
use NoughtsAndCrosses\Core\GameIdentity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GamesSpec extends ObjectBehavior
{
    function it_is_a_list_of_games()
    {
        $this->shouldHaveType('NoughtsAndCrosses\Core\Games');
    }

    function it_returns_a_game_when_game_is_found_by_id()
    {
        $id = GameIdentity::createNew();
        $this->findById($id)->shouldHaveType(Game::class);
    }
}


