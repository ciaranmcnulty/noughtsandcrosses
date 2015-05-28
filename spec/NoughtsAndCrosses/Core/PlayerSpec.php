<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Player;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlayerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('NoughtsAndCrosses\Core\Player');
    }

    function it_is_equal_to_the_same_player()
    {
        $this->beConstructedThrough('O', []);
        $this->shouldBeLike(Player::O());
    }

    function it_is_not_equal_to_a_different_player()
    {
        $this->beConstructedThrough('O', []);
        $this->shouldNotBeLike(Player::X());
    }
}
