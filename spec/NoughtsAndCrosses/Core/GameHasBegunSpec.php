<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Event\Event;
use NoughtsAndCrosses\Core\GameIdentity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameHasBegunSpec extends ObjectBehavior
{
    private $id;

    function let()
    {
        $this->id = GameIdentity::createNew();
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
