<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Command\CommandHandler;
use NoughtsAndCrosses\Core\Event\Event;
use NoughtsAndCrosses\Core\GameIdentity;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\Square;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SquarePlayedByPlayerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(GameIdentity::createNew(), Square::atPosition('A', 1), Player::O());
    }

    function it_is_an_event()
    {
        $this->shouldHaveType(Event::class);
    }

    function it_exposes_game_identity()
    {
        $this->id()->shouldHaveType(GameIdentity::class);
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
