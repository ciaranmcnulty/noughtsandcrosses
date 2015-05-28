<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Square;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SquareSpec extends ObjectBehavior
{
    function it_is_equal_to_another_square_in_the_same_position()
    {
        $this->beConstructedThrough('atPosition', ["A", 1]);
        $this->shouldBeLike(Square::atPosition('A', 1));
    }

    function it_is_not_equal_to_another_square_in_a_different_position()
    {
        $this->beConstructedThrough('atPosition', ["A", 1]);
        $this->shouldNotBeLike(Square::atPosition('B', 1));
    }
}
