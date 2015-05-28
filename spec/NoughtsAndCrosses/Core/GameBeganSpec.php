<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Event\Event;
use NoughtsAndCrosses\Core\GameId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameBeganSpec extends ObjectBehavior
{
    private $id;

    function let()
    {
        $this->id = GameId::createNew();
        $this->beConstructedWith($this->id);
    }

    function it_is_an_event()
    {
        $this->shouldHaveType(Event::class);
    }

    function it_has_a_game_identity()
    {
        $this->id()->shouldReturn($this->id);
    }
}
