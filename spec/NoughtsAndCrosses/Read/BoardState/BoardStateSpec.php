<?php

namespace spec\NoughtsAndCrosses\Read\BoardState;

use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\Square;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BoardStateSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('start');
    }

    function it_sets_squares_to_empty_state_at_start()
    {
        $this->playerForSquare(Square::atPosition('A', 1))->shouldBeNull();
    }
}
