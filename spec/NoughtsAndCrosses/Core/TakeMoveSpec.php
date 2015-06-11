<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Infrastructure\Command;
use NoughtsAndCrosses\Core\GameId;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\Square;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TakeMoveSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(GameId::createNew(), Square::atPosition('A', 1), Player::O());
    }

    function it_is_a_command()
    {
        $this->shouldHaveType(Command::class);
    }

    function it_exposes_game_identity()
    {
        $this->id()->shouldHaveType(GameId::class);
    }

    function it_exposes_square()
    {
        $this->square()->shouldBeLike(Square::atPosition('A', 1));
    }

    function it_exposes_player()
    {
        $this->player()->shouldBeLike(Player::O());
    }
}
