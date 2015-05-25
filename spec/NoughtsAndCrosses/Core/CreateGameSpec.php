<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Infrastructure\Command;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateGameSpec extends ObjectBehavior
{
    function it_is_a_command()
    {
        $this->shouldHaveType(Command::class);
    }
}
