<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Infrastructure\Event;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameCreatedSpec extends ObjectBehavior
{
    function it_is_an_event()
    {
        $this->shouldHaveType(Event::class);
    }
}
