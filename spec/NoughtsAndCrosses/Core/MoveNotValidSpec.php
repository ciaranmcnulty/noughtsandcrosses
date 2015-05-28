<?php

namespace spec\NoughtsAndCrosses\Core;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoveNotValidSpec extends ObjectBehavior
{
    function it_is_an_exception()
    {
        $this->shouldHaveType('Exception');
    }
}
