<?php

namespace spec\NoughtsAndCrosses\Core;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameCreatedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('NoughtsAndCrosses\Core\GameCreated');
    }
}
