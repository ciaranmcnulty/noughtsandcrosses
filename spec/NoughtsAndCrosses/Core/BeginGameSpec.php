<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Command\Command;
use NoughtsAndCrosses\Core\GameIdentity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rhumsaa\Uuid\Uuid;

class BeginGameSpec extends ObjectBehavior
{
    private $id;

    function let()
    {
        $this->id = GameIdentity::createNew();
        $this->beConstructedWith($this->id);
    }

    function it_is_a_command()
    {
        $this->shouldHaveType(Command::class);
    }

    function it_exposes_identity()
    {
        $this->id()->shouldEqual($this->id);
    }
}
