<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Event\Event;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameHasBegunSpec extends ObjectBehavior
{
    function it_is_an_event()
    {
        $this->shouldHaveType(Event::class);
    }
}
